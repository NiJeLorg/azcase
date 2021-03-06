from django.shortcuts import render
from django.http import HttpResponse, HttpResponseRedirect

# import all azcase_admin models
from azcase_admin.models import *

# paginator
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger

# use Q for OR queries 
import operator
from django.db.models import Q

# for chaining querysets together
from itertools import chain

#for using arrays of ids
import json

#for emailing from the system
from django.core import mail


# Create your views here.
def index(request):
	# get count of location duplicates not yet handled
	locationDupsCount = azcase_locations_duplicates.objects.filter(notDuplicate__exact=False).count()

	# get count of user duplicates not yet handled
	userDupsCount = azcase_users_duplicates.objects.filter(notDuplicate__exact=False).count()

	# get count of site duplicates not yet handled
	siteDupsCount = azcase_sites_duplicates.objects.filter(notDuplicate__exact=False).count()

	verifiedCount = azcase_sites.objects.filter(verified__exact=2).count()

	summerVerifiedCount = azcase_sites.objects.filter(verified__exact=1, summer__exact=True).count()
	syVerifiedCount = azcase_sites.objects.filter(verified__exact=1).exclude(summer__exact=True).count()
	
	context_dict = {'verifiedCount': verifiedCount, 'locationDupsCount':locationDupsCount, 'userDupsCount':userDupsCount, 'siteDupsCount':siteDupsCount, 'summerVerifiedCount':summerVerifiedCount, 'syVerifiedCount': syVerifiedCount}
	return render(request, 'azcase_admin/index.html', context_dict)

def sitesUsersLocations(request):
	# what method are we using?
	if request.method == 'GET':
		# get search terms for pagination
		siteName = request.GET.get("siteName","")
		siteEmail = request.GET.get("siteEmail","")
		sitePhone = request.GET.get("sitePhone","")
		userName = request.GET.get("userName","")
		userEmail = request.GET.get("userEmail","")
		userOrgName = request.GET.get("userOrgName","")
		locationName = request.GET.get("locationName","")
		locationAddress = request.GET.get("locationAddress","")
		locationCity = request.GET.get("locationCity","")
		locationZip = request.GET.get("locationZip","")
		programPage = request.GET.get('programPage',"")
		userPage = request.GET.get('userPage',"")
		locationPage = request.GET.get('locationPage',"")
	elif request.method == 'POST':
		# get search terms if any entered
		siteName = request.POST.get("siteName","")
		siteEmail = request.POST.get("siteEmail","")
		sitePhone = request.POST.get("sitePhone","")
		userName = request.POST.get("userName","")
		userEmail = request.POST.get("userEmail","")
		userOrgName = request.POST.get("userOrgName","")
		locationName = request.POST.get("locationName","")
		locationAddress = request.POST.get("locationAddress","")
		locationCity = request.POST.get("locationCity","")
		locationZip = request.POST.get("locationZip","")
		programPage = request.POST.get('programPage',"")
		userPage = request.POST.get('userPage',"")
		locationPage = request.POST.get('locationPage',"")

	# add keyword queries here; using Q for custom AND queries
	# site queries
	if siteName != '':
		siteNameQuery = Q(name__icontains=siteName)
	else:
		siteNameQuery = Q()

	if siteEmail != '':
		siteEmailQuery = Q(email__icontains=siteEmail)
	else:
		siteEmailQuery = Q()

	if sitePhone != '':
		sitePhoneQuery = Q(phone__icontains=sitePhone)
	else:
		sitePhoneQuery = Q()

	# user queries
	if userName != '':
		userNameQuery = Q(username__icontains=userName)
	else:
		userNameQuery = Q()

	if userEmail != '':
		userEmailQuery = Q(useremail__icontains=userEmail)
	else:
		userEmailQuery = Q()

	if userOrgName != '':
		userOrgNameQuery = Q(orgname__icontains=userOrgName)
	else:
		userOrgNameQuery = Q()

	# location queries
	if locationName != '':
		locationNameQuery = Q(name__icontains=locationName)
	else:
		locationNameQuery = Q()

	if locationAddress != '':
		locationAddressQuery = Q(address__icontains=locationAddress)
	else:
		locationAddressQuery = Q()

	if locationCity != '':
		locationCityQuery = Q(city__icontains=locationCity)
	else:
		locationCityQuery = Q()

	if locationZip != '':
		locationZipQuery = Q(zip__icontains=locationZip)
	else:
		locationZipQuery = Q()

	# if sites searched, then apply that search to users and locations
	if siteName != '' or siteEmail != '' or sitePhone != '':
		# site query 
		siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery
		# get list of siteIDs and select only the users/locations that match
		siteIds = azcase_sites.objects.filter(siteQuery).values('siteid')
		userIds_list = azcase_user_sites_junction.objects.filter(siteid__in=siteIds).values_list('userid', flat=True)
		locationIds_list = azcase_sites_locations_junction.objects.filter(siteid__in=siteIds).values_list('locationid', flat=True)
		#add these to queries for users and locations
		userInSiteQuery = Q(userid__in=userIds_list)
		locationInSiteQuery = Q(locationid__in=locationIds_list)

	else:
		userInSiteQuery = Q()
		locationInSiteQuery = Q()

	# if user searched, then apply that search to sites and locations
	if userName != '' or userEmail != '' or userOrgName != '':
		# user query 
		userQuery = userNameQuery & userEmailQuery & userOrgNameQuery
		# get list of userIDs and select only the sites/locations that match
		userIds = azcase_users.objects.filter(userQuery).values('userid')
		siteIds_list = azcase_user_sites_junction.objects.filter(userid__in=userIds).values_list('siteid', flat=True)
		locationIds_list = azcase_sites_locations_junction.objects.filter(siteid__in=siteIds_list).values_list('locationid', flat=True)
		#add these to queries for users and locations
		siteInUserQuery = Q(siteid__in=siteIds_list)
		locationInUserQuery = Q(locationid__in=locationIds_list)

	else:
		siteInUserQuery = Q()
		locationInUserQuery = Q()

	# if location searched, then apply that search to sites and users
	if locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '':
		# location query 
		locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery
		# get list of locationIDs and select only the sites/users that match
		locationIds = azcase_locations.objects.filter(locationQuery).values('locationid')
		siteIds_list = azcase_sites_locations_junction.objects.filter(locationid__in=locationIds).values_list('siteid', flat=True)
		userIds_list = azcase_user_sites_junction.objects.filter(siteid__in=siteIds_list).values_list('userid', flat=True)
		#add these to queries for users and locations
		siteInLocationQuery = Q(siteid__in=siteIds_list)
		userInLocationQuery = Q(userid__in=userIds_list)

	else:
		siteInLocationQuery = Q()
		userInLocationQuery = Q()

	# site query 
	siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery & siteInUserQuery & siteInLocationQuery

	# user query 
	userQuery = userNameQuery & userEmailQuery & userOrgNameQuery & userInSiteQuery & userInLocationQuery

	# location query 
	locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery & locationInSiteQuery & locationInUserQuery

	#get sites
	site_list = azcase_sites.objects.filter(siteQuery).order_by('name')  
	sitesCount = len(site_list)
	sitePaginator = Paginator(site_list, 50) # show a table of 50 
	site_number_of_pages = sitePaginator.num_pages

	try:
		sites = sitePaginator.page(programPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		sites = sitePaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		sites = sitePaginator.page(sitePaginator.num_pages)
	
	for site in sites:
		# get the number of users/users for each site
		usersCount = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).count()
		if usersCount == 0:
			site.usersCount = 'No Programs'
		elif usersCount == 1:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' User'
		else:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' Users'

		# format ages served
		site.agesserved = formatAge(site.age5, site.age6, site.age7, site.age8, site.age9, site.age10, site.age11, site.age12, site.age13, site.age14, site.age15, site.age16, site.age17, site.age18)
		# find out if possible duplicates
		siteDupLookup1 = Q(siteid1__exact=site.siteid)
		siteDupLookup2 = Q(siteid2__exact=site.siteid)

		siteDupsCount = azcase_sites_duplicates.objects.filter(siteDupLookup1 | siteDupLookup2).count()

		if siteDupsCount > 0:
			site.duplicate = True
		else: 
			site.duplicate = False

	#get users
	user_list = azcase_users.objects.filter(userQuery).order_by('username')
	usersCount = len(user_list)
	userPaginator = Paginator(user_list, 50) # show a table of 50 
	user_number_of_pages = userPaginator.num_pages

	try:
		userObjects = userPaginator.page(userPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		userObjects = userPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		userObjects = userPaginator.page(userPaginator.num_pages)

	# get the number of sites attached to each user
	for userObject in userObjects:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).count()
		if siteCount == 0:
			userObject.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		userDupLookup1 = Q(userid1__exact=userObject.userid)
		userDupLookup2 = Q(userid2__exact=userObject.userid)

		userDupsCount = azcase_users_duplicates.objects.filter(userDupLookup1 | userDupLookup2).count()

		if userDupsCount > 0:
			userObject.duplicate = True
		else: 
			userObject.duplicate = False

	#get locations
	locations_list = azcase_locations.objects.filter(locationQuery).order_by('name')
	locationsCount = len(locations_list)
	locationPaginator = Paginator(locations_list, 50) # show a table of 50 
	location_number_of_pages = locationPaginator.num_pages

	try:
		locations = locationPaginator.page(locationPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		locations = locationPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		locations = locationPaginator.page(locationPaginator.num_pages)

	# get the number of sites attached to each location
	for location in locations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).count()
		if siteCount == 0:
			location.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		locationDupLookup1 = Q(locationid1__exact=location.locationid)
		locationDupLookup2 = Q(locationid2__exact=location.locationid)

		locationDupsCount = azcase_locations_duplicates.objects.filter(locationDupLookup1 | locationDupLookup2).count()

		if locationDupsCount > 0:
			location.duplicate = True
		else: 
			location.duplicate = False


	context_dict = {'sites':sites, 'userObjects': userObjects, 'locations': locations, 'siteName': siteName, 'siteEmail': siteEmail, 'sitePhone': sitePhone, 'userName': userName, 'userEmail': userEmail, 'userOrgName':userOrgName, 'locationName': locationName, 'locationAddress': locationAddress, 'locationCity': locationCity, 'locationZip': locationZip, 'site_number_of_pages':site_number_of_pages, 'user_number_of_pages':user_number_of_pages, 'location_number_of_pages': location_number_of_pages, 'programPage': programPage, 'userPage': userPage, 'locationPage': locationPage, 'sitesCount': sitesCount, 'usersCount': usersCount, 'locationsCount': locationsCount}

	return render(request, 'azcase_admin/siteUserLocationsTables.html', context_dict)

def userManagement(request):
	# what method are we using?
	if request.method == 'GET':
		# get search terms for pagination
		siteName = request.GET.get("siteName","")
		siteEmail = request.GET.get("siteEmail","")
		sitePhone = request.GET.get("sitePhone","")
		userName = request.GET.get("userName","")
		userEmail = request.GET.get("userEmail","")
		userOrgName = request.GET.get("userOrgName","")
		locationName = request.GET.get("locationName","")
		locationAddress = request.GET.get("locationAddress","")
		locationCity = request.GET.get("locationCity","")
		locationZip = request.GET.get("locationZip","")
		programPage = request.GET.get('programPage',"")
		userPage = request.GET.get('userPage',"")
		locationPage = request.GET.get('locationPage',"")
	elif request.method == 'POST':
		# get search terms if any entered
		siteName = request.POST.get("siteName","")
		siteEmail = request.POST.get("siteEmail","")
		sitePhone = request.POST.get("sitePhone","")
		userName = request.POST.get("userName","")
		userEmail = request.POST.get("userEmail","")
		userOrgName = request.POST.get("userOrgName","")
		locationName = request.POST.get("locationName","")
		locationAddress = request.POST.get("locationAddress","")
		locationCity = request.POST.get("locationCity","")
		locationZip = request.POST.get("locationZip","")
		programPage = request.POST.get('programPage',"")
		userPage = request.POST.get('userPage',"")
		locationPage = request.POST.get('locationPage',"")

	# add keyword queries here; using Q for custom AND queries
	# site queries
	if siteName != '':
		siteNameQuery = Q(name__icontains=siteName)
	else:
		siteNameQuery = Q()

	if siteEmail != '':
		siteEmailQuery = Q(email__icontains=siteEmail)
	else:
		siteEmailQuery = Q()

	if sitePhone != '':
		sitePhoneQuery = Q(phone__icontains=sitePhone)
	else:
		sitePhoneQuery = Q()

	# user queries
	if userName != '':
		userNameQuery = Q(username__icontains=userName)
	else:
		userNameQuery = Q()

	if userEmail != '':
		userEmailQuery = Q(useremail__icontains=userEmail)
	else:
		userEmailQuery = Q()

	if userOrgName != '':
		userOrgNameQuery = Q(orgname__icontains=userOrgName)
	else:
		userOrgNameQuery = Q()

	# location queries
	if locationName != '':
		locationNameQuery = Q(name__icontains=locationName)
	else:
		locationNameQuery = Q()

	if locationAddress != '':
		locationAddressQuery = Q(address__icontains=locationAddress)
	else:
		locationAddressQuery = Q()

	if locationCity != '':
		locationCityQuery = Q(city__icontains=locationCity)
	else:
		locationCityQuery = Q()

	if locationZip != '':
		locationZipQuery = Q(zip__icontains=locationZip)
	else:
		locationZipQuery = Q()

	# if sites searched, then apply that search to users and locations
	if siteName != '' or siteEmail != '' or sitePhone != '':
		# site query 
		siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery
		# get list of siteIDs and select only the users/locations that match
		siteIds = azcase_sites.objects.filter(siteQuery).values('siteid')
		userIds_list = azcase_user_sites_junction.objects.filter(siteid__in=siteIds).values_list('userid', flat=True)
		locationIds_list = azcase_sites_locations_junction.objects.filter(siteid__in=siteIds).values_list('locationid', flat=True)
		#add these to queries for users and locations
		userInSiteQuery = Q(userid__in=userIds_list)
		locationInSiteQuery = Q(locationid__in=locationIds_list)

	else:
		userInSiteQuery = Q()
		locationInSiteQuery = Q()

	# if user searched, then apply that search to sites and locations
	if userName != '' or userEmail != '' or userOrgName != '':
		# user query 
		userQuery = userNameQuery & userEmailQuery & userOrgNameQuery
		# get list of userIDs and select only the sites/locations that match
		userIds = azcase_users.objects.filter(userQuery).values('userid')
		siteIds_list = azcase_user_sites_junction.objects.filter(userid__in=userIds).values_list('siteid', flat=True)
		locationIds_list = azcase_sites_locations_junction.objects.filter(siteid__in=siteIds_list).values_list('locationid', flat=True)
		#add these to queries for users and locations
		siteInUserQuery = Q(siteid__in=siteIds_list)
		locationInUserQuery = Q(locationid__in=locationIds_list)

	else:
		siteInUserQuery = Q()
		locationInUserQuery = Q()

	# if location searched, then apply that search to sites and users
	if locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '':
		# location query 
		locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery
		# get list of locationIDs and select only the sites/users that match
		locationIds = azcase_locations.objects.filter(locationQuery).values('locationid')
		siteIds_list = azcase_sites_locations_junction.objects.filter(locationid__in=locationIds).values_list('siteid', flat=True)
		userIds_list = azcase_user_sites_junction.objects.filter(siteid__in=siteIds_list).values_list('userid', flat=True)
		#add these to queries for users and locations
		siteInLocationQuery = Q(siteid__in=siteIds_list)
		userInLocationQuery = Q(userid__in=userIds_list)

	else:
		siteInLocationQuery = Q()
		userInLocationQuery = Q()

	# site query 
	siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery & siteInUserQuery & siteInLocationQuery

	# user query 
	userQuery = userNameQuery & userEmailQuery & userOrgNameQuery & userInSiteQuery & userInLocationQuery

	# location query 
	locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery & locationInSiteQuery & locationInUserQuery

	#get sites
	site_list = azcase_sites.objects.filter(siteQuery).order_by('name')
	sitesCount = len(site_list)  
	sitePaginator = Paginator(site_list, 50) # show a table of 50 
	site_number_of_pages = sitePaginator.num_pages

	try:
		sites = sitePaginator.page(programPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		sites = sitePaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		sites = sitePaginator.page(sitePaginator.num_pages)
	
	for site in sites:
		# get the number of users/users for each site
		usersCount = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).count()
		if usersCount == 0:
			site.usersCount = 'No Programs'
		elif usersCount == 1:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' User'
		else:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' Users'

		# format ages served
		site.agesserved = formatAge(site.age5, site.age6, site.age7, site.age8, site.age9, site.age10, site.age11, site.age12, site.age13, site.age14, site.age15, site.age16, site.age17, site.age18)
		# find out if possible duplicates
		siteDupLookup1 = Q(siteid1__exact=site.siteid)
		siteDupLookup2 = Q(siteid2__exact=site.siteid)

		siteDupsCount = azcase_sites_duplicates.objects.filter(siteDupLookup1 | siteDupLookup2).count()

		if siteDupsCount > 0:
			site.duplicate = True
		else: 
			site.duplicate = False

	#get users
	user_list = azcase_users.objects.filter(userQuery).order_by('username')
	usersCount = len(user_list)  
	userPaginator = Paginator(user_list, 50) # show a table of 50 
	user_number_of_pages = userPaginator.num_pages

	try:
		userObjects = userPaginator.page(userPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		userObjects = userPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		userObjects = userPaginator.page(userPaginator.num_pages)

	# get the number of sites attached to each user
	for userObject in userObjects:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).count()
		if siteCount == 0:
			userObject.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		userDupLookup1 = Q(userid1__exact=userObject.userid)
		userDupLookup2 = Q(userid2__exact=userObject.userid)

		userDupsCount = azcase_users_duplicates.objects.filter(userDupLookup1 | userDupLookup2).count()

		if userDupsCount > 0:
			userObject.duplicate = True
		else: 
			userObject.duplicate = False

	#get locations
	locations_list = azcase_locations.objects.filter(locationQuery).order_by('name')
	locationsCount = len(locations_list)  
	locationPaginator = Paginator(locations_list, 50) # show a table of 50 
	location_number_of_pages = locationPaginator.num_pages

	try:
		locations = locationPaginator.page(locationPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		locations = locationPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		locations = locationPaginator.page(locationPaginator.num_pages)

	# get the number of sites attached to each location
	for location in locations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).count()
		if siteCount == 0:
			location.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		locationDupLookup1 = Q(locationid1__exact=location.locationid)
		locationDupLookup2 = Q(locationid2__exact=location.locationid)

		locationDupsCount = azcase_locations_duplicates.objects.filter(locationDupLookup1 | locationDupLookup2).count()

		if locationDupsCount > 0:
			location.duplicate = True
		else: 
			location.duplicate = False


	context_dict = {'sites':sites, 'userObjects': userObjects, 'locations': locations, 'siteName': siteName, 'siteEmail': siteEmail, 'sitePhone': sitePhone, 'userName': userName, 'userEmail': userEmail, 'userOrgName':userOrgName, 'locationName': locationName, 'locationAddress': locationAddress, 'locationCity': locationCity, 'locationZip': locationZip, 'site_number_of_pages':site_number_of_pages, 'user_number_of_pages':user_number_of_pages, 'location_number_of_pages': location_number_of_pages, 'programPage': programPage, 'userPage': userPage, 'locationPage': locationPage, 'sitesCount': sitesCount, 'usersCount': usersCount, 'locationsCount': locationsCount}

	return render(request, 'azcase_admin/userManagementTable.html', context_dict)

def reassignPrograms(request):
	# what method are we using?
	if request.method == 'GET':
		# get search terms for pagination
		siteName = request.GET.get("siteName","")
		siteEmail = request.GET.get("siteEmail","")
		sitePhone = request.GET.get("sitePhone","")
		userName = request.GET.get("userName","")
		userEmail = request.GET.get("userEmail","")
		userOrgName = request.GET.get("userOrgName","")
		locationName = request.GET.get("locationName","")
		locationAddress = request.GET.get("locationAddress","")
		locationCity = request.GET.get("locationCity","")
		locationZip = request.GET.get("locationZip","")
		programPage = request.GET.get('programPage',"")
		userPage = request.GET.get('userPage',"")
		locationPage = request.GET.get('locationPage',"")
	elif request.method == 'POST':
		# get search terms if any entered
		siteName = request.POST.get("siteName","")
		siteEmail = request.POST.get("siteEmail","")
		sitePhone = request.POST.get("sitePhone","")
		userName = request.POST.get("userName","")
		userEmail = request.POST.get("userEmail","")
		userOrgName = request.POST.get("userOrgName","")
		locationName = request.POST.get("locationName","")
		locationAddress = request.POST.get("locationAddress","")
		locationCity = request.POST.get("locationCity","")
		locationZip = request.POST.get("locationZip","")
		programPage = request.POST.get('programPage',"")
		userPage = request.POST.get('userPage',"")
		locationPage = request.POST.get('locationPage',"")

	# add keyword queries here; using Q for custom AND queries
	# site queries
	if siteName != '':
		siteNameQuery = Q(name__icontains=siteName)
	else:
		siteNameQuery = Q()

	if siteEmail != '':
		siteEmailQuery = Q(email__icontains=siteEmail)
	else:
		siteEmailQuery = Q()

	if sitePhone != '':
		sitePhoneQuery = Q(phone__icontains=sitePhone)
	else:
		sitePhoneQuery = Q()

	# user queries
	if userName != '':
		userNameQuery = Q(username__icontains=userName)
	else:
		userNameQuery = Q()

	if userEmail != '':
		userEmailQuery = Q(useremail__icontains=userEmail)
	else:
		userEmailQuery = Q()

	if userOrgName != '':
		userOrgNameQuery = Q(orgname__icontains=userOrgName)
	else:
		userOrgNameQuery = Q()

	# location queries
	if locationName != '':
		locationNameQuery = Q(name__icontains=locationName)
	else:
		locationNameQuery = Q()

	if locationAddress != '':
		locationAddressQuery = Q(address__icontains=locationAddress)
	else:
		locationAddressQuery = Q()

	if locationCity != '':
		locationCityQuery = Q(city__icontains=locationCity)
	else:
		locationCityQuery = Q()

	if locationZip != '':
		locationZipQuery = Q(zip__icontains=locationZip)
	else:
		locationZipQuery = Q()

	# if sites searched, then apply that search to users and locations
	if siteName != '' or siteEmail != '' or sitePhone != '':
		# site query 
		siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery
		# get list of siteIDs and select only the users/locations that match
		siteIds = azcase_sites.objects.filter(siteQuery).values('siteid')
		userIds_list = azcase_user_sites_junction.objects.filter(siteid__in=siteIds).values_list('userid', flat=True)
		locationIds_list = azcase_sites_locations_junction.objects.filter(siteid__in=siteIds).values_list('locationid', flat=True)
		#add these to queries for users and locations
		userInSiteQuery = Q(userid__in=userIds_list)
		locationInSiteQuery = Q(locationid__in=locationIds_list)

	else:
		userInSiteQuery = Q()
		locationInSiteQuery = Q()

	# if user searched, then apply that search to sites and locations
	if userName != '' or userEmail != '' or userOrgName != '':
		# user query 
		userQuery = userNameQuery & userEmailQuery & userOrgNameQuery
		# get list of userIDs and select only the sites/locations that match
		userIds = azcase_users.objects.filter(userQuery).values('userid')
		siteIds_list = azcase_user_sites_junction.objects.filter(userid__in=userIds).values_list('siteid', flat=True)
		locationIds_list = azcase_sites_locations_junction.objects.filter(siteid__in=siteIds_list).values_list('locationid', flat=True)
		#add these to queries for users and locations
		siteInUserQuery = Q(siteid__in=siteIds_list)
		locationInUserQuery = Q(locationid__in=locationIds_list)

	else:
		siteInUserQuery = Q()
		locationInUserQuery = Q()

	# if location searched, then apply that search to sites and users
	if locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '':
		# location query 
		locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery
		# get list of locationIDs and select only the sites/users that match
		locationIds = azcase_locations.objects.filter(locationQuery).values('locationid')
		siteIds_list = azcase_sites_locations_junction.objects.filter(locationid__in=locationIds).values_list('siteid', flat=True)
		userIds_list = azcase_user_sites_junction.objects.filter(siteid__in=siteIds_list).values_list('userid', flat=True)
		#add these to queries for users and locations
		siteInLocationQuery = Q(siteid__in=siteIds_list)
		userInLocationQuery = Q(userid__in=userIds_list)

	else:
		siteInLocationQuery = Q()
		userInLocationQuery = Q()

	# site query 
	siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery & siteInUserQuery & siteInLocationQuery

	# user query 
	userQuery = userNameQuery & userEmailQuery & userOrgNameQuery & userInSiteQuery & userInLocationQuery

	# location query 
	locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery & locationInSiteQuery & locationInUserQuery

	#get sites
	site_list = azcase_sites.objects.filter(siteQuery).order_by('name')  
	sitesCount = len(site_list)  
	sitePaginator = Paginator(site_list, 50) # show a table of 50 
	site_number_of_pages = sitePaginator.num_pages

	try:
		sites = sitePaginator.page(programPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		sites = sitePaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		sites = sitePaginator.page(sitePaginator.num_pages)
	
	for site in sites:
		# get the number of users/users for each site
		usersCount = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).count()
		if usersCount == 0:
			site.usersCount = 'No Programs'
		elif usersCount == 1:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' User'
		else:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' Users'

		# format ages served
		site.agesserved = formatAge(site.age5, site.age6, site.age7, site.age8, site.age9, site.age10, site.age11, site.age12, site.age13, site.age14, site.age15, site.age16, site.age17, site.age18)
		# find out if possible duplicates
		siteDupLookup1 = Q(siteid1__exact=site.siteid)
		siteDupLookup2 = Q(siteid2__exact=site.siteid)

		siteDupsCount = azcase_sites_duplicates.objects.filter(siteDupLookup1 | siteDupLookup2).count()

		if siteDupsCount > 0:
			site.duplicate = True
		else: 
			site.duplicate = False

	#get users
	user_list = azcase_users.objects.filter(userQuery).order_by('username')
	usersCount = len(user_list)  
	userPaginator = Paginator(user_list, 50) # show a table of 50 
	user_number_of_pages = userPaginator.num_pages

	try:
		userObjects = userPaginator.page(userPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		userObjects = userPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		userObjects = userPaginator.page(userPaginator.num_pages)

	# get the number of sites attached to each user
	for userObject in userObjects:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).count()
		if siteCount == 0:
			userObject.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		userDupLookup1 = Q(userid1__exact=userObject.userid)
		userDupLookup2 = Q(userid2__exact=userObject.userid)

		userDupsCount = azcase_users_duplicates.objects.filter(userDupLookup1 | userDupLookup2).count()

		if userDupsCount > 0:
			userObject.duplicate = True
		else: 
			userObject.duplicate = False

	#get locations
	locations_list = azcase_locations.objects.filter(locationQuery).order_by('name')
	locationsCount = len(locations_list)  
	locationPaginator = Paginator(locations_list, 50) # show a table of 50 
	location_number_of_pages = locationPaginator.num_pages

	try:
		locations = locationPaginator.page(locationPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		locations = locationPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		locations = locationPaginator.page(locationPaginator.num_pages)

	# get the number of sites attached to each location
	for location in locations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).count()
		if siteCount == 0:
			location.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		locationDupLookup1 = Q(locationid1__exact=location.locationid)
		locationDupLookup2 = Q(locationid2__exact=location.locationid)

		locationDupsCount = azcase_locations_duplicates.objects.filter(locationDupLookup1 | locationDupLookup2).count()

		if locationDupsCount > 0:
			location.duplicate = True
		else: 
			location.duplicate = False


	context_dict = {'sites':sites, 'userObjects': userObjects, 'locations': locations, 'siteName': siteName, 'siteEmail': siteEmail, 'sitePhone': sitePhone, 'userName': userName, 'userEmail': userEmail, 'userOrgName':userOrgName, 'locationName': locationName, 'locationAddress': locationAddress, 'locationCity': locationCity, 'locationZip': locationZip, 'site_number_of_pages':site_number_of_pages, 'user_number_of_pages':user_number_of_pages, 'location_number_of_pages': location_number_of_pages, 'programPage': programPage, 'userPage': userPage, 'locationPage': locationPage, 'sitesCount': sitesCount, 'usersCount': usersCount, 'locationsCount': locationsCount}

	return render(request, 'azcase_admin/reassignPrograms.html', context_dict)


def filterSites(request):

	# get search terms if any entered
	siteName = request.GET.get("siteName","")
	siteEmail = request.GET.get("siteEmail","")
	sitePhone = request.GET.get("sitePhone","")

	userName = request.GET.get("userName","")
	userEmail = request.GET.get("userEmail","")
	userOrgName = request.GET.get("userOrgName","")

	locationName = request.GET.get("locationName","")
	locationAddress = request.GET.get("locationAddress","")
	locationCity = request.GET.get("locationCity","")
	locationZip = request.GET.get("locationZip","")

	manage = request.GET.get("manage","")


	# add keyword queries here; using Q for OR queries
	if siteName != '':
		siteNameQuery = Q(name__icontains=siteName)
	else:
		siteNameQuery = Q()

	if siteEmail != '':
		siteEmailQuery = Q(email__icontains=siteEmail)
	else:
		siteEmailQuery = Q()

	if sitePhone != '':
		sitePhoneQuery = Q(phone__icontains=sitePhone)
	else:
		sitePhoneQuery = Q()

	# if users searched, then query for users
	if userName != '' or userEmail != '' or userOrgName != '':
		if userName != '':
			userNameQuery = Q(username__icontains=userName)
		else:
			userNameQuery = Q()

		if userEmail != '':
			userEmailQuery = Q(useremail__icontains=userEmail)
		else:
			userEmailQuery = Q()

		if userOrgName != '':
			userOrgNameQuery = Q(orgname__icontains=userOrgName)
		else:
			userOrgNameQuery = Q()

		userQuery = userNameQuery & userEmailQuery & userOrgNameQuery
		users_list = azcase_users.objects.filter(userQuery).values('userid')
		user_siteids_list = azcase_user_sites_junction.objects.filter(userid__in=users_list).values_list('siteid', flat=True)

	# if locations searched, then query for locations
	if locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '':
		if locationName != '':
			locationNameQuery = Q(name__icontains=locationName)
		else:
			locationNameQuery = Q()

		if locationAddress != '':
			locationAddressQuery = Q(address__icontains=locationAddress)
		else:
			locationAddressQuery = Q()

		if locationCity != '':
			locationCityQuery = Q(city__icontains=locationCity)
		else:
			locationCityQuery = Q()

		if locationZip != '':
			locationZipQuery = Q(zip__icontains=locationZip)
		else:
			locationZipQuery = Q()

		locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery
		locations_list = azcase_locations.objects.filter(locationQuery).values('locationid')
		location_siteids_list = azcase_sites_locations_junction.objects.filter(locationid__in=locations_list).values_list('siteid', flat=True)

	# if locations and users concatonate querysets
	if (userName != '' or userEmail != '' or userOrgName != '') and (locationName != '' or locationAddress != '' or locationCity != '' or locationZip != ''):
		siteInUserQuery = Q(siteid__in=user_siteids_list)
		siteInLocationQuery = Q(siteid__in=location_siteids_list)
	elif userName != '' or userEmail != '' or userOrgName != '':
		siteInUserQuery = Q(siteid__in=user_siteids_list)
		siteInLocationQuery = Q()
	elif locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '': 
		siteInUserQuery = Q()
		siteInLocationQuery = Q(siteid__in=location_siteids_list)
	else:
		siteInUserQuery = Q()
		siteInLocationQuery = Q()

	#query 
	query = siteNameQuery & siteEmailQuery & sitePhoneQuery & siteInUserQuery & siteInLocationQuery

	#get sites
	site_list = azcase_sites.objects.filter(query).order_by('name')  
	sitesCount = len(site_list)
	sitePaginator = Paginator(site_list, 50) # show a table of 50 
	site_number_of_pages = sitePaginator.num_pages

	programPage = request.GET.get('programPage')
	try:
		sites = sitePaginator.page(programPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		sites = sitePaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		sites = sitePaginator.page(sitePaginator.num_pages)

	for site in sites:
		# get the number of users/users for each site
		usersCount = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).count()
		if usersCount == 0:
			site.usersCount = 'No Programs'
		elif usersCount == 1:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' User'
		else:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' Users'

		site.agesserved = formatAge(site.age5, site.age6, site.age7, site.age8, site.age9, site.age10, site.age11, site.age12, site.age13, site.age14, site.age15, site.age16, site.age17, site.age18)
		# find out if possible duplicates
		siteDupLookup1 = Q(siteid1__exact=site.siteid)
		siteDupLookup2 = Q(siteid2__exact=site.siteid)

		siteDupsCount = azcase_sites_duplicates.objects.filter(siteDupLookup1 | siteDupLookup2).count()

		if siteDupsCount > 0:
			site.duplicate = True
		else: 
			site.duplicate = False


	context_dict = {'sites':sites, 'siteName': siteName, 'siteEmail': siteEmail, 'sitePhone': sitePhone, 'userName': userName, 'userEmail': userEmail, 'userOrgName':userOrgName, 'locationName': locationName, 'locationAddress': locationAddress, 'locationCity': locationCity, 'locationZip': locationZip, 'site_number_of_pages':site_number_of_pages, 'manage': manage, 'sitesCount':sitesCount}

	return render(request, 'azcase_admin/filter_sites.html', context_dict)


def filterUsers(request):

	# get search terms if any entered
	siteName = request.GET.get("siteName","")
	siteEmail = request.GET.get("siteEmail","")
	sitePhone = request.GET.get("sitePhone","")

	userName = request.GET.get("userName","")
	userEmail = request.GET.get("userEmail","")
	userOrgName = request.GET.get("userOrgName","")

	locationName = request.GET.get("locationName","")
	locationAddress = request.GET.get("locationAddress","")
	locationCity = request.GET.get("locationCity","")
	locationZip = request.GET.get("locationZip","")

	manage = request.GET.get("manage","")


	# add keyword queries here; using Q for OR queries
	if userName != '':
		userNameQuery = Q(username__icontains=userName)
	else:
		userNameQuery = Q()

	if userEmail != '':
		userEmailQuery = Q(useremail__icontains=userEmail)
	else:
		userEmailQuery = Q()

	if userOrgName != '':
		userOrgNameQuery = Q(orgname__icontains=userOrgName)
	else:
		userOrgNameQuery = Q()

	# if sites searched, then query for those
	if siteName != '' or siteEmail != '' or sitePhone != '':
		if siteName != '':
			siteNameQuery = Q(name__icontains=siteName)
		else:
			siteNameQuery = Q()

		if siteEmail != '':
			siteEmailQuery = Q(email__icontains=siteEmail)
		else:
			siteEmailQuery = Q()

		if sitePhone != '':
			sitePhoneQuery = Q(phone__icontains=sitePhone)
		else:
			sitePhoneQuery = Q()

		siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery
		sites_list = azcase_sites.objects.filter(siteQuery).values('siteid')
		site_userids_list = azcase_user_sites_junction.objects.filter(siteid__in=sites_list).values_list('userid', flat=True)

	# if locations searched, then pull sites for adding to kwargs
	if locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '':
		if locationName != '':
			locationNameQuery = Q(name__icontains=locationName)
		else:
			locationNameQuery = Q()

		if locationAddress != '':
			locationAddressQuery = Q(address__icontains=locationAddress)
		else:
			locationAddressQuery = Q()

		if locationCity != '':
			locationCityQuery = Q(city__icontains=locationCity)
		else:
			locationCityQuery = Q()

		if locationZip != '':
			locationZipQuery = Q(zip__icontains=locationZip)
		else:
			locationZipQuery = Q()

		locationQuery = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery
		locations_list = azcase_locations.objects.filter(locationQuery).values('locationid')
		location_siteids_list = azcase_sites_locations_junction.objects.filter(locationid__in=locations_list).values('siteid')
		location_userids_list = azcase_user_sites_junction.objects.filter(siteid__in=location_siteids_list).values_list('userid', flat=True)


	# if sites and locations; concatonate querysets
	if (siteName != '' or siteEmail != '' or sitePhone != '') and (locationName != '' or locationAddress != '' or locationCity != '' or locationZip != ''):
		userInSiteQuery = Q(userid__in=site_userids_list)
		userInLocationQuery = Q(userid__in=location_userids_list)
	elif siteName != '' or siteEmail != '' or sitePhone != '':
		userInSiteQuery = Q(userid__in=site_userids_list)
		userInLocationQuery = Q()
	elif locationName != '' or locationAddress != '' or locationCity != '' or locationZip != '': 
		userInSiteQuery = Q()
		userInLocationQuery = Q(userid__in=location_userids_list)
	else:
		userInSiteQuery = Q()
		userInLocationQuery = Q()

	#query 
	query = userNameQuery & userEmailQuery & userOrgNameQuery & userInSiteQuery & userInLocationQuery

	#get users
	user_list = azcase_users.objects.filter(query).order_by('username')  
	usersCount = len(user_list)
	userPaginator = Paginator(user_list, 50) # show a table of 50 
	user_number_of_pages = userPaginator.num_pages

	userPage = request.GET.get('userPage')
	try:
		userObjects = userPaginator.page(userPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		userObjects = userPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		userObjects = userPaginator.page(userPaginator.num_pages)

	# get the number of sites attached to each user
	for userObject in userObjects:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).count()
		if siteCount == 0:
			userObject.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid).values('siteid')
			userObject.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		userDupLookup1 = Q(userid1__exact=userObject.userid)
		userDupLookup2 = Q(userid2__exact=userObject.userid)

		userDupsCount = azcase_users_duplicates.objects.filter(userDupLookup1 | userDupLookup2).count()

		if userDupsCount > 0:
			userObject.duplicate = True
		else: 
			userObject.duplicate = False


	context_dict = {'userObjects':userObjects, 'siteName': siteName, 'siteEmail': siteEmail, 'sitePhone': sitePhone, 'userName': userName, 'userEmail': userEmail, 'userOrgName':userOrgName, 'locationName': locationName, 'locationAddress': locationAddress, 'locationCity': locationCity, 'locationZip': locationZip, 'user_number_of_pages':user_number_of_pages, 'manage': manage, 'usersCount':usersCount}

	return render(request, 'azcase_admin/filter_users.html', context_dict)


def filterLocations(request):

	# get search terms if any entered
	siteName = request.GET.get("siteName","")
	siteEmail = request.GET.get("siteEmail","")
	sitePhone = request.GET.get("sitePhone","")

	userName = request.GET.get("userName","")
	userEmail = request.GET.get("userEmail","")
	userOrgName = request.GET.get("userOrgName","")

	locationName = request.GET.get("locationName","")
	locationAddress = request.GET.get("locationAddress","")
	locationCity = request.GET.get("locationCity","")
	locationZip = request.GET.get("locationZip","")

	# add keyword queries here; using Q for OR queries
	if locationName != '':
		locationNameQuery = Q(name__icontains=locationName)
	else:
		locationNameQuery = Q()

	if locationAddress != '':
		locationAddressQuery = Q(address__icontains=locationAddress)
	else:
		locationAddressQuery = Q()

	if locationCity != '':
		locationCityQuery = Q(city__icontains=locationCity)
	else:
		locationCityQuery = Q()

	if locationZip != '':
		locationZipQuery = Q(zip__icontains=locationZip)
	else:
		locationZipQuery = Q()

	# if sites searched, then query for those
	if siteName != '' or siteEmail != '' or sitePhone != '':
		if siteName != '':
			siteNameQuery = Q(name__icontains=siteName)
		else:
			siteNameQuery = Q()

		if siteEmail != '':
			siteEmailQuery = Q(email__icontains=siteEmail)
		else:
			siteEmailQuery = Q()

		if sitePhone != '':
			sitePhoneQuery = Q(phone__icontains=sitePhone)
		else:
			sitePhoneQuery = Q()

		siteQuery = siteNameQuery & siteEmailQuery & sitePhoneQuery
		sites_list = azcase_sites.objects.filter(siteQuery).values('siteid')
		site_locationids_list = azcase_sites_locations_junction.objects.filter(siteid__in=sites_list).values_list('locationid', flat=True)

	# if users searched, then query for users
	if userName != '' or userEmail != '' or userOrgName != '':
		if userName != '':
			userNameQuery = Q(username__icontains=userName)
		else:
			userNameQuery = Q()

		if userEmail != '':
			userEmailQuery = Q(useremail__icontains=userEmail)
		else:
			userEmailQuery = Q()

		if userOrgName != '':
			userOrgNameQuery = Q(orgname__icontains=userOrgName)
		else:
			userOrgNameQuery = Q()

		userQuery = userNameQuery & userEmailQuery & userOrgNameQuery
		users_list = azcase_users.objects.filter(userQuery).values('userid')
		user_siteids_list = azcase_user_sites_junction.objects.filter(userid__in=users_list).values('siteid')
		user_locationids_list = azcase_sites_locations_junction.objects.filter(siteid__in=user_siteids_list).values_list('locationid', flat=True)


	# if sites and locations; concatonate querysets
	if (siteName != '' or siteEmail != '' or sitePhone != '') and (userName != '' or userEmail != '' or userOrgName != ''):
		locationInSiteQuery = Q(locationid__in=site_locationids_list)
		locationInUserQuery = Q(locationid__in=user_locationids_list)
	elif siteName != '' or siteEmail != '' or sitePhone != '':
		locationInSiteQuery = Q(locationid__in=site_locationids_list)
		locationInUserQuery = Q()
	elif userName != '' or userEmail != '' or userOrgName != '': 
		locationInSiteQuery = Q()
		locationInUserQuery = Q(locationid__in=user_locationids_list)
	else:
		locationInSiteQuery = Q()
		locationInUserQuery = Q()

	#query 
	query = locationNameQuery & locationAddressQuery & locationCityQuery & locationZipQuery & locationInSiteQuery & locationInUserQuery

	#get users
	locations_list = azcase_locations.objects.filter(query).order_by('name') 
	locationsCount = len(locations_list)
	locationsPaginator = Paginator(locations_list, 50) # show a table of 50 
	location_number_of_pages = locationsPaginator.num_pages

	locationPage = request.GET.get('locationPage')
	try:
		locations = locationsPaginator.page(locationPage)
	except PageNotAnInteger:
		# If page is not an integer, deliver first page.
		locations = locationsPaginator.page(1)
	except EmptyPage:
		# If page is out of range (e.g. 9999), deliver last page of results.
		locations = locationsPaginator.page(locationsPaginator.num_pages)

	# get the number of sites attached to each location
	for location in locations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).count()
		if siteCount == 0:
			location.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Programs'

		# find out if possible duplicates
		locationDupLookup1 = Q(locationid1__exact=location.locationid)
		locationDupLookup2 = Q(locationid2__exact=location.locationid)

		locationDupsCount = azcase_locations_duplicates.objects.filter(locationDupLookup1 | locationDupLookup2).count()

		if locationDupsCount > 0:
			location.duplicate = True
		else: 
			location.duplicate = False


	context_dict = {'locations':locations, 'siteName': siteName, 'siteEmail': siteEmail, 'sitePhone': sitePhone, 'userName': userName, 'userEmail': userEmail, 'userOrgName':userOrgName, 'locationName': locationName, 'locationAddress': locationAddress, 'locationCity': locationCity, 'locationZip': locationZip, 'location_number_of_pages':location_number_of_pages, 'locationsCount':locationsCount}

	return render(request, 'azcase_admin/filter_locations.html', context_dict)


def publicAdvSearch(request):
	return render(request, 'azcase_admin/publicAdvSearch.html', {})

def addPrograms(request):
	return render(request, 'azcase_admin/addPrograms.html', {})

def addUsers(request):
	return render(request, 'azcase_admin/addUsers.html', {})

def addLocations(request):
	return render(request, 'azcase_admin/addLocations.html', {})

def downloadData(request):
	return render(request, 'azcase_admin/downloadData.html', {})

def editPrograms(request):
	siteid = request.GET.get("siteid","")
	return render(request, 'azcase_admin/editPrograms.html', {'siteid':siteid})

def editUsers(request):
	userid = request.GET.get("userid","")
	return render(request, 'azcase_admin/editUsers.html', {'userid':userid})

def editLocations(request):
	locationid = request.GET.get("locationid","")
	return render(request, 'azcase_admin/editLocations.html', {'locationid':locationid})

def verifyPrograms(request):
	return render(request, 'azcase_admin/verifyPrograms.html', {})

def removePrograms(request):
	siteid = request.GET.get("siteid","")
	return render(request, 'azcase_admin/removePrograms.html', {'siteid':siteid})

def removeUsers(request):
	userid = request.GET.get("userid","")
	return render(request, 'azcase_admin/removeUsers.html', {'userid':userid})

def removeLocations(request):
	locationid = request.GET.get("locationid","")
	return render(request, 'azcase_admin/removeLocations.html', {'locationid':locationid})

def comparePrograms(request):
	siteids = request.GET.get("siteids","")
	siteids = json.loads(siteids);
	sites = azcase_sites.objects.filter(siteid__in=siteids).order_by('name')

	for site in sites:
		site.agesserved = formatAge(site.age5, site.age6, site.age7, site.age8, site.age9, site.age10, site.age11, site.age12, site.age13, site.age14, site.age15, site.age16, site.age17, site.age18)

	return render(request, 'azcase_admin/comparePrograms.html', {'sites':sites})

def compareUsers(request):
	userids = request.GET.get("userids","")
	userids = json.loads(userids);
	users = azcase_users.objects.filter(userid__in=userids).order_by('username')

	# get the number of sites attached to each user
	for user in users:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=user.userid).count()
		if siteCount == 0:
			user.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=user.userid).values('siteid')
			user.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			user.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=user.userid).values('siteid')
			user.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			user.siteCount = str(siteCount) + ' Programs'

	return render(request, 'azcase_admin/compareUsers.html', {'users':users})

def compareLocations(request):
	locationids = request.GET.get("locationids","")
	locationids = json.loads(locationids);
	locations = azcase_locations.objects.filter(locationid__in=locationids).order_by('name')

	# get the number of sites attached to each location
	for location in locations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).count()
		if siteCount == 0:
			location.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid).values('siteid')
			location.sitesLocation = azcase_sites.objects.filter(siteid__in=siteIds)
			location.siteCount = str(siteCount) + ' Programs'

	return render(request, 'azcase_admin/compareLocations.html', {'locations':locations})


def emailUsers(request):

	if request.method == 'GET':
		userids = request.GET.get("userids","")
		subject = request.GET.get("subject","A Message from the AZ Afterschool Directory")
		message = request.GET.get("message","")
		userids = json.loads(userids);
		useremails = azcase_users.objects.filter(userid__in=userids).values_list('useremail')

		if useremails and message:
			#open an email connection
			connection = mail.get_connection()
			connection.open()
			for useremail in useremails:
				if useremail:
					try:
						mail.send_mail(subject=subject, message=message, from_email='AzCASE Directory <azcase.directory@gmail.com>', recipient_list=useremail, connection=connection, html_message=message)
					except mail.BadHeaderError:
						return HttpResponse('Invalid header found.')
				
			connection.close()
			return HttpResponse('')
		else: 
			return HttpResponseBadRequest('')

	else:
		return HttpResponseBadRequest('')


def emailAllUsers(request):
	if request.method == 'GET':
		subject = request.GET.get("subject","A Message from the AZ Afterschool Directory")
		message = request.GET.get("message","")
		useremails = azcase_users.objects.all().values_list('useremail')

		if useremails and message:
			#open an email connection
			connection = mail.get_connection()
			connection.open()
			for useremail in useremails:
				if useremail:
					try:
						mail.send_mail(subject=subject, message=message, from_email='AzCASE Directory <azcase.directory@gmail.com>', recipient_list=useremail, connection=connection, html_message=message)
					except mail.BadHeaderError:
						return HttpResponse('Invalid header found.')
				
			connection.close()
			return HttpResponse('')
		else: 
			return HttpResponseBadRequest('')

	else:
		return HttpResponseBadRequest('')


def updateDuplicateRecords(request):
	# pull all locations records
	locations = azcase_locations.objects.all()

	for location in locations:
		# search for any other potental duplicates
		locationNameQuery = Q(name__icontains=location.name)
		locationAddressQuery = Q(address__icontains=location.address)
		locationIDQuery = Q(locationid__exact=location.locationid)

		locationDups = azcase_locations.objects.filter(locationNameQuery & locationAddressQuery).exclude(locationIDQuery)

		# check to make sure duplicates aren't in duplicate record databasse yet, 
		for locationDup in locationDups:
			locationDupLookup1 = Q(locationid1__in=[location, locationDup])
			locationDupLookup2 = Q(locationid2__in=[location, locationDup])

			locationDupsCount = azcase_locations_duplicates.objects.filter(locationDupLookup1 & locationDupLookup2).count()

			if locationDupsCount == 0:
				azcase_locations_duplicates.objects.create(locationid1=location, locationid2=locationDup)

	# pull all user records
	users = azcase_users.objects.all()

	for user in users:
		if user.username:
			# search for any other potental duplicates
			userNameQuery = Q(username__icontains=user.username)
		else:
			userNameQuery = Q()

		if user.orgname:
			userOrgNameQuery = Q(orgname__icontains=user.orgname)
		else:
			userOrgNameQuery = Q()

		userIDQuery = Q(userid__exact=user.userid)

		userDups = azcase_users.objects.filter(userNameQuery & userOrgNameQuery).exclude(userIDQuery)

		# check to make sure duplicates aren't in duplicate record databasse yet, 
		for userDup in userDups:
			userDupLookup1 = Q(userid1__in=[user, userDup])
			userDupLookup2 = Q(userid2__in=[user, userDup])

			userDupsCount = azcase_users_duplicates.objects.filter(userDupLookup1 & userDupLookup2).count()

			if userDupsCount == 0:
				azcase_users_duplicates.objects.create(userid1=user, userid2=userDup)

	# pull all site records
	sites = azcase_sites.objects.all()

	for site in sites:
		if site.name:
			# search for any other potental duplicates
			siteNameQuery = Q(name__icontains=site.name)
		else:
			siteNameQuery = Q()

		if site.summer is not None:
			siteSummerQuery = Q(summer__exact=site.summer)
		else:
			siteSummerQuery = Q()

		siteIDQuery = Q(siteid__exact=site.siteid)

		# select location name/address and see if they're similar -- if so add group of siteids to this query
		locationids_list = azcase_sites_locations_junction.objects.filter(siteid__exact=site.siteid).values('locationid')
		locations = azcase_locations.objects.filter(locationid__in=locationids_list)

		for location in locations:
			address = location.address
			# select all locations with that address
			locationsWAddress = azcase_locations.objects.filter(address__icontains=address).values('locationid')
			#get matching siteids
			siteids_list = azcase_sites_locations_junction.objects.filter(locationid__in=locationsWAddress).values('siteid')
			if siteids_list:
				potentialSiteIDs = Q(siteid__in=siteids_list)
			else:
				potentialSiteIDs = Q()

		siteDups = azcase_sites.objects.filter(siteNameQuery & siteSummerQuery & potentialSiteIDs).exclude(siteIDQuery)

		# check to make sure duplicates aren't in duplicate record databasse yet, 
		for siteDup in siteDups:
			siteDupLookup1 = Q(siteid1__in=[site, siteDup])
			siteDupLookup2 = Q(siteid2__in=[site, siteDup])

			siteDupsCount = azcase_sites_duplicates.objects.filter(siteDupLookup1 & siteDupLookup2).count()

			if siteDupsCount == 0:
				azcase_sites_duplicates.objects.create(siteid1=site, siteid2=siteDup)

	return HttpResponse('')

def duplicatePrograms(request):
	duplicatePrograms = azcase_sites_duplicates.objects.filter(notDuplicate__exact=False)

	return render(request, 'azcase_admin/duplicatePrograms.html', {'duplicatePrograms':duplicatePrograms})

def duplicateProgram(request):
	siteid = request.GET.get("siteid","")
	site = azcase_sites.objects.get(siteid__exact=siteid)
	siteDupLookup1 = Q(siteid1__exact=site)
	siteDupLookup2 = Q(siteid2__exact=site)

	duplicatePrograms = azcase_sites_duplicates.objects.filter((siteDupLookup1 | siteDupLookup2) & Q(notDuplicate__exact=False))

	return render(request, 'azcase_admin/duplicatePrograms.html', {'duplicatePrograms':duplicatePrograms})


def markNotDuplicateProgram(request):
	siteids = request.GET.get("siteids","")
	siteids = json.loads(siteids);
	kwargs = {}
	kwargs['siteid1__in'] = siteids
	kwargs['siteid2__in'] = siteids
	duplicatePrograms = azcase_sites_duplicates.objects.filter(**kwargs)
	for dup in duplicatePrograms:
		dup.notDuplicate = True
		dup.save()

	return HttpResponseRedirect('/duplicatePrograms/')

def duplicateUsers(request):
	duplicateUsers = azcase_users_duplicates.objects.filter(notDuplicate__exact=False)

	# get the number of sites attached to each user
	for userObject in duplicateUsers:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid1.userid).count()
		if siteCount == 0:
			userObject.userid1.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid1.userid).values('siteid')
			userObject.userid1.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid1.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid1.userid).values('siteid')
			userObject.userid1.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid1.siteCount = str(siteCount) + ' Programs'

		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid2.userid).count()
		if siteCount == 0:
			userObject.userid2.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid2.userid).values('siteid')
			userObject.userid2.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid2.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid2.userid).values('siteid')
			userObject.userid2.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid2.siteCount = str(siteCount) + ' Programs'

	return render(request, 'azcase_admin/duplicateUsers.html', {'duplicateUsers':duplicateUsers})

def duplicateUser(request):
	userid = request.GET.get("userid","")
	user = azcase_users.objects.get(userid__exact=userid)
	userDupLookup1 = Q(userid1__exact=user)
	userDupLookup2 = Q(userid2__exact=user)

	duplicateUsers = azcase_users_duplicates.objects.filter((userDupLookup1 | userDupLookup2) & Q(notDuplicate__exact=False))

	# get the number of sites attached to each user
	for userObject in duplicateUsers:
		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid1.userid).count()
		if siteCount == 0:
			userObject.userid1.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid1.userid).values('siteid')
			userObject.userid1.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid1.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid1.userid).values('siteid')
			userObject.userid1.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid1.siteCount = str(siteCount) + ' Programs'

		siteCount = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid2.userid).count()
		if siteCount == 0:
			userObject.userid2.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid2.userid).values('siteid')
			userObject.userid2.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid2.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_user_sites_junction.objects.filter(userid__exact=userObject.userid2.userid).values('siteid')
			userObject.userid2.sitesUsers = azcase_sites.objects.filter(siteid__in=siteIds)
			userObject.userid2.siteCount = str(siteCount) + ' Programs'

	return render(request, 'azcase_admin/duplicateUsers.html', {'duplicateUsers':duplicateUsers})

def markNotDuplicateUser(request):
	userids = request.GET.get("userids","")
	userids = json.loads(userids);
	kwargs = {}
	kwargs['userid1__in'] = userids
	kwargs['userid2__in'] = userids
	duplicateUsers = azcase_users_duplicates.objects.filter(**kwargs)
	for dup in duplicateUsers:
		dup.notDuplicate = True
		dup.save()

	return HttpResponseRedirect('/duplicateUsers/')


def duplicateLocations(request):
	duplicateLocations = azcase_locations_duplicates.objects.filter(notDuplicate__exact=False)

	# get the number of sites attached to each user
	for location in duplicateLocations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid1.locationid).count()
		if siteCount == 0:
			location.locationid1.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid1.locationid).values('siteid')
			location.locationid1.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid1.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid1.locationid).values('siteid')
			location.locationid1.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid1.siteCount = str(siteCount) + ' Programs'

		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid2.locationid).count()
		if siteCount == 0:
			location.locationid2.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid2.locationid).values('siteid')
			location.locationid2.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid2.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid2.locationid).values('siteid')
			location.locationid2.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid2.siteCount = str(siteCount) + ' Programs'

	return render(request, 'azcase_admin/duplicateLocations.html', {'duplicateLocations':duplicateLocations})

def duplicateLocation(request):
	locationid = request.GET.get("locationid","")
	location = azcase_locations.objects.get(locationid__exact=locationid)
	locationDupLookup1 = Q(locationid1__exact=location)
	locationDupLookup2 = Q(locationid2__exact=location)

	duplicateLocations = azcase_locations_duplicates.objects.filter((locationDupLookup1 | locationDupLookup2) & Q(notDuplicate__exact=False))

	# get the number of sites attached to each user
	for location in duplicateLocations:
		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid1.locationid).count()
		if siteCount == 0:
			location.locationid1.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid1.locationid).values('siteid')
			location.locationid1.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid1.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid1.locationid).values('siteid')
			location.locationid1.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid1.siteCount = str(siteCount) + ' Programs'

		siteCount = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid2.locationid).count()
		if siteCount == 0:
			location.locationid2.siteCount = 'No Programs'
		elif siteCount == 1:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid2.locationid).values('siteid')
			location.locationid2.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid2.siteCount = str(siteCount) + ' Program'
		else:
			siteIds = azcase_sites_locations_junction.objects.filter(locationid__exact=location.locationid2.locationid).values('siteid')
			location.locationid2.sitesLocations = azcase_sites.objects.filter(siteid__in=siteIds)
			location.locationid2.siteCount = str(siteCount) + ' Programs'

	return render(request, 'azcase_admin/duplicateLocations.html', {'duplicateLocations':duplicateLocations})


def markNotDuplicateLocation(request):
	locationids = request.GET.get("locationids","")
	locationids = json.loads(locationids);
	kwargs = {}
	kwargs['locationid1__in'] = locationids
	kwargs['locationid2__in'] = locationids
	duplicateLocations = azcase_locations_duplicates.objects.filter(**kwargs)
	for dup in duplicateLocations:
		dup.notDuplicate = True
		dup.save()

	return HttpResponseRedirect('/duplicateLocations/')

def manageUsersData(request):
	userid = request.GET.get("userid","")
	return render(request, 'azcase_admin/manageUsersData.html', {'userid':userid})

def customReports(request):
	return render(request, 'azcase_admin/customReports.html', {})


def reassignProgramsList(request):
	# what method are we using?
	if request.method == 'GET':
		siteids = request.GET.get("siteids","")
		siteids = json.loads(siteids);
		sites = azcase_sites.objects.filter(siteid__in=siteids).order_by('name')
	elif request.method == 'POST':
		siteids = request.POST.get("siteids","")
		userid = request.POST.get("userSelected","")
		siteids = json.loads(siteids);
		sites = azcase_sites.objects.filter(siteid__in=siteids)
		user = azcase_users.objects.get(userid__exact=userid)
		for site in sites:
			obj = azcase_user_sites_junction.objects.update_or_create(userid=user, siteid=site)

	for site in sites:
		# get the number of users/users for each site
		usersCount = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).count()
		if usersCount == 0:
			site.usersCount = 'No Programs'
		elif usersCount == 1:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' User'
		else:
			userIds = azcase_user_sites_junction.objects.filter(siteid__exact=site.siteid).values('userid')
			site.sitesUsers = azcase_users.objects.filter(userid__in=userIds)
			site.usersCount = str(usersCount) + ' Users'

		site.agesserved = formatAge(site.age5, site.age6, site.age7, site.age8, site.age9, site.age10, site.age11, site.age12, site.age13, site.age14, site.age15, site.age16, site.age17, site.age18)

	# get all users in the system for combo box
	users = azcase_users.objects.all().order_by('username')

	return render(request, 'azcase_admin/reassignProgramsList.html', {'sites':sites, 'users':users})



def formatAge(age5, age6, age7, age8, age9, age10, age11, age12, age13, age14, age15, age16, age17, age18):
	# formats ages served
	agesserved5 = ''
	agesserved6 = ''
	agesserved7 = ''
	agesserved8 = ''
	agesserved9 = ''
	agesserved10 = ''
	agesserved11 = ''
	agesserved12 = ''
	agesserved13 = ''
	agesserved14 = ''
	agesserved15 = ''
	agesserved16 = ''
	agesserved17 = ''
	agesserved18 = ''
	spread6 = 0
	spread7 = 0
	spread8 = 0
	spread9 = 0
	spread10 = 0
	spread11 = 0
	spread12 = 0
	spread13 = 0
	spread14 = 0
	spread15 = 0
	spread16 = 0
	spread17 = 0
	spread18 = 0
	nothing = ''

	if (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved5 = '5-18'
		spread18 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved5 = '5-17'
		spread17 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved5 = '5-16'
		spread16 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved5 = '5-15'
		spread15 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True) :
		agesserved5 = '5-14'
		spread14 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True) :
		agesserved5 = '5-13'
		spread13 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True) :
		agesserved5 = '5-12'
		spread12 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True) :
		agesserved5 = '5-11'
		spread11 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True and age10==True) :
		agesserved5 = '5-10'
		spread10 = 1
	elif (age5==True and age6==True and age7==True and age8==True and age9==True) :
		agesserved5 = '5-9'
		spread9 = 1
	elif (age5==True and age6==True and age7==True and age8==True) :
		agesserved5 = '5-8'
		spread8 = 1
	elif (age5==True and age6==True and age7==True) :
		agesserved5 = '5-7'
		spread7 = 1
	elif (age5==True and age6==True) :
		agesserved5 = '5-6'
		spread6 = 1
	elif (age5==True) :
		agesserved5 = '5'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved6 = '6-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved6 = '6-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved6 = '6-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved6 = '6-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True) :
		agesserved6 = '6-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True) :
		agesserved6 = '6-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True) :
		agesserved6 = '6-12'
		spread12 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True and age11==True) :
		agesserved6 = '6-11'
		spread11 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True and age10==True) :
		agesserved6 = '6-10'
		spread10 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True and age9==True) :
		agesserved6 = '6-9'
		spread9 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True and age8==True) :
		agesserved6 = '6-8'
		spread8 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True and age7==True) :
		agesserved6 = '6-7'
		spread7 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0 and spread6==0) and age6==True) :
		agesserved6 = '6'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved7 = '7-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved7 = '7-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved7 = '7-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved7 = '7-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True) :
		agesserved7 = '7-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True) :
		agesserved7 = '7-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True and age12==True) :
		agesserved7 = '7-12'
		spread12 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True and age11==True) :
		agesserved7 = '7-11'
		spread11 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True and age10==True) :
		agesserved7 = '7-10'
		spread10 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True and age9==True) :
		agesserved7 = '7-9'
		spread9 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True and age8==True) :
		agesserved7 = '7-8'
		spread8 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0 and spread7==0) and age7==True) :
		agesserved7 = '7'
		spread7 = 1
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved8 = '8-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved8 = '8-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved8 = '8-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved8 = '8-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True) :
		agesserved8 = '8-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True and age13==True) :
		agesserved8 = '8-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True and age12==True) :
		agesserved8 = '8-12'
		spread12 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True and age11==True) :
		agesserved8 = '8-11'
		spread11 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True and age10==True) :
		agesserved8 = '8-10'
		spread10 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True and age9==True) :
		agesserved8 = '8-9'
		spread9 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0 and spread8==0) and age8==True) :
		agesserved8 = '8'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved9 = '9-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved9 = '9-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved9 = '9-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved9 = '9-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True and age13==True and age14==True) :
		agesserved9 = '9-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True and age13==True) :
		agesserved9 = '9-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True and age12==True) :
		agesserved9 = '9-12'
		spread12 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True and age11==True) :
		agesserved9 = '9-11'
		spread11 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True and age10==True) :
		agesserved9 = '9-10'
		spread10 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0 and spread9==0) and age9==True) :
		agesserved9 = '9'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved10 = '10-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved10 = '10-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved10 = '10-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved10 = '10-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True and age13==True and age14==True) :
		agesserved10 = '10-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True and age13==True) :
		agesserved10 = '10-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True and age12==True) :
		agesserved10 = '10-12'
		spread12 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True and age11==True) :
		agesserved10 = '10-11'
		spread11 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0 and spread10==0) and age10==True) :
		agesserved10 = '10-10'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved11 = '11-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved11 = '11-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved11 = '11-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True and age13==True and age14==True and age15==True) :
		agesserved11 = '11-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True and age13==True and age14==True) :
		agesserved11 = '11-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True and age13==True) :
		agesserved11 = '11-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True and age12==True) :
		agesserved11 = '11-12'
		spread12 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0 and spread11==0) and age11==True) :
		agesserved11 = '11'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved12 = '12-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved12 = '12-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True and age13==True and age14==True and age15==True and age16==True) :
		agesserved12 = '12-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True and age13==True and age14==True and age15==True) :
		agesserved12 = '12-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True and age13==True and age14==True) :
		agesserved12 = '12-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True and age13==True) :
		agesserved12 = '12-13'
		spread13 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0 and spread12==0) and age12==True) :
		agesserved12 = '12'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0) and age13==True and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved13 = '13-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0) and age13==True and age14==True and age15==True and age16==True and age17==True) :
		agesserved13 = '13-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0) and age13==True and age14==True and age15==True and age16==True) :
		agesserved13 = '13-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0) and age13==True and age14==True and age15==True) :
		agesserved13 = '13-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0) and age13==True and age14==True) :
		agesserved13 = '13-14'
		spread14 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0 and spread13==0) and age13==True) :
		agesserved13 = '13'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0) and age14==True and age15==True and age16==True and age17==True and age18==True) :
		agesserved14 = '14-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0) and age14==True and age15==True and age16==True and age17==True) :
		agesserved14 = '14-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0) and age14==True and age15==True and age16==True) :
		agesserved14 = '14-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0) and age14==True and age15==True) :
		agesserved14 = '14-15'
		spread15 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0 and spread14==0) and age14==True) :
		agesserved14 = '14'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0 and spread15==0) and age15==True and age16==True and age17==True and age18==True) :
		agesserved15 = '15-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0) and age15==True and age16==True and age17==True) :
		agesserved15 = '15-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0) and age15==True and age16==True) :
		agesserved15 = '15-16'
		spread16 = 1
	elif ((spread18==0 and spread17==0 and spread16==0 and spread15==0) and age15==True) :
		agesserved15 = '15'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0 and spread16==0) and age16==True and age17==True and age18==True) :
		agesserved16 = '16-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0 and spread16==0) and age16==True and age17==True) :
		agesserved16 = '16-17'
		spread17 = 1
	elif ((spread18==0 and spread17==0 and spread16==0) and age16==True) :
		agesserved16 = '16'
	else:
		nothing = ''

	if ((spread18==0 and spread17==0) and age17==True and age18==True) :
		agesserved17 = '17-18'
		spread18 = 1
	elif ((spread18==0 and spread17==0) and age17==True) :
		agesserved17 = '17'
	else:
		nothing = ''

	if (spread18==0 and age18==True) :
		agesserved18 = '18'
	else:
		nothing = ''


	if (agesserved5!='' and agesserved6!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved7!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved8!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved9!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved10!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved11!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved12!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved13!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved14!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved15!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved16!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved17!='') :
		semi1 = ' '
	elif (agesserved5!='' and agesserved18!='') :
		semi1 = ' '
	else:
		semi1 = ''
	

	if (agesserved6!='' and agesserved7!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved8!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved9!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved10!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved11!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved12!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved13!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved14!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved15!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved16!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved17!='') :
		semi2 = ' '
	elif (agesserved6!='' and agesserved18!='') :
		semi2 = ' '
	else:
		semi2 = ''
	

	if (agesserved7!='' and agesserved8!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved9!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved10!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved11!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved12!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved13!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved14!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved15!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved16!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved17!='') :
		semi3 = ' '
	elif (agesserved7!='' and agesserved18!='') :
		semi3 = ' '
	else:
		semi3 = ''
	

	if (agesserved8!='' and agesserved9!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved10!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved11!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved12!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved13!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved14!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved15!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved16!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved17!='') :
		semi4 = ' '
	elif (agesserved8!='' and agesserved18!='') :
		semi4 = ' '
	else:
		semi4 = ''
	

	if (agesserved9!='' and agesserved10!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved11!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved12!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved13!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved14!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved15!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved16!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved17!='') :
		semi5 = ' '
	elif (agesserved9!='' and agesserved18!='') :
		semi5 = ' '
	else:
		semi5 = ''
	

	if (agesserved10!='' and agesserved11!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved12!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved13!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved14!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved15!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved16!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved17!='') :
		semi6 = ' '
	elif (agesserved10!='' and agesserved18!='') :
		semi6 = ' '
	else:
		semi6 = ''
	

	if (agesserved11!='' and agesserved12!='') :
		semi7 = ' '
	elif (agesserved11!='' and agesserved13!='') :
		semi7 = ' '
	elif (agesserved11!='' and agesserved14!='') :
		semi7 = ' '
	elif (agesserved11!='' and agesserved15!='') :
		semi7 = ' '
	elif (agesserved11!='' and agesserved16!='') :
		semi7 = ' '
	elif (agesserved11!='' and agesserved17!='') :
		semi7 = ' '
	elif (agesserved11!='' and agesserved18!='') :
		semi7 = ' '
	else:
		semi7 = ''
	

	if (agesserved12!='' and agesserved13!='') :
		semi8 = ' '
	elif (agesserved12!='' and agesserved14!='') :
		semi8 = ' '
	elif (agesserved12!='' and agesserved15!='') :
		semi8 = ' '
	elif (agesserved12!='' and agesserved16!='') :
		semi8 = ' '
	elif (agesserved12!='' and agesserved17!='') :
		semi8 = ' '
	elif (agesserved12!='' and agesserved18!='') :
		semi8 = ' '
	else:
		semi8 = ''
	

	if (agesserved13!='' and agesserved14!='') :
		semi9 = ' '
	elif (agesserved13!='' and agesserved15!='') :
		semi9 = ' '
	elif (agesserved13!='' and agesserved16!='') :
		semi9 = ' '
	elif (agesserved13!='' and agesserved17!='') :
		semi9 = ' '
	elif (agesserved13!='' and agesserved18!='') :
		semi9 = ' '
	else:
		semi9 = ''
	

	if (agesserved14!='' and agesserved15!='') :
		semi10 = ' '
	elif (agesserved14!='' and agesserved16!='') :
		semi10 = ' '
	elif (agesserved14!='' and agesserved17!='') :
		semi10 = ' '
	elif (agesserved14!='' and agesserved18!='') :
		semi10 = ' '
	else:
		semi10 = ''
	

	if (agesserved15!='' and agesserved16!='') :
		semi11 = ' '
	elif (agesserved15!='' and agesserved17!='') :
		semi11 = ' '
	elif (agesserved15!='' and agesserved18!='') :
		semi11 = ' '
	else:
		semi11 = ''
	

	if (agesserved16!='' and agesserved17!='') :
		semi12 = ' '
	elif (agesserved16!='' and agesserved18!='') :
		semi12 = ' '
	else:
		semi12 = ''
	

	if (agesserved17!='' and agesserved18!='') :
		semi13 = ' '
	else:
		semi13 = ''
	

	# put all the age ranges together
	agesserved = agesserved5 + semi1 + agesserved6 + semi2  + agesserved7 + semi3 + agesserved8 + semi4 + agesserved9 + semi5 + agesserved10 + semi6 + agesserved11 + semi7 + agesserved12 + semi8 + agesserved13 + semi9 + agesserved14 + semi10 + agesserved15 + semi11 + agesserved16 + semi12 + agesserved17 + semi13 + agesserved18
	return agesserved

