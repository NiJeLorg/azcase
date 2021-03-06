from django.db import models
from django.forms import ModelForm

# AzCASE models here
class azcase_locations(models.Model):
	locationid = models.IntegerField(null=False, primary_key=True)
	updated = models.DateTimeField(null=True, auto_now=True)
	name = models.CharField(null=True, max_length=500)
	namesp = models.CharField(null=True, max_length=500)
	address = models.CharField(null=True, max_length=500)
	address2 = models.CharField(null=True,max_length=500)
	city = models.CharField(null=True,max_length=50)
	state = models.CharField(null=True,max_length=2)
	zip = models.CharField(null=True,max_length=10)
	lat = models.DecimalField(null=True, max_digits=12, decimal_places=8)
	lon = models.DecimalField(null=True, max_digits=12, decimal_places=8)
	surveykey = models.CharField(null=True, max_length=20)
	the_geom = models.CharField(null=True,max_length=500)

	class Meta:
		db_table = 'azcase_locations'

	def __unicode__(self):
		return self.name


class azcase_sites(models.Model):
	siteid = models.IntegerField(null=False, primary_key=True)
	updated = models.DateTimeField(null=True, auto_now=True) 
	name = models.CharField(null=True,max_length=500)
	namesp = models.CharField(null=True,max_length=500)
	phone = models.CharField(null=True,max_length=50)
	fax = models.CharField(null=True,max_length=50)
	email = models.CharField(null=True,max_length=200)
	pubemail = models.NullBooleanField(null=True, default=False)
	url = models.CharField(null=True,max_length=200)
	summer = models.NullBooleanField(null=True, default=False)
	summercode = models.IntegerField(null=True)
	age5 = models.NullBooleanField(null=True, default=False)
	age6 = models.NullBooleanField(null=True, default=False)
	age7 = models.NullBooleanField(null=True, default=False)
	age8 = models.NullBooleanField(null=True, default=False)
	age9 = models.NullBooleanField(null=True, default=False)
	age10 = models.NullBooleanField(null=True, default=False)
	age11 = models.NullBooleanField(null=True, default=False)
	age12 = models.NullBooleanField(null=True, default=False)
	age13 = models.NullBooleanField(null=True, default=False)
	age14 = models.NullBooleanField(null=True, default=False)
	age15 = models.NullBooleanField(null=True, default=False)
	age16 = models.NullBooleanField(null=True, default=False)
	age17 = models.NullBooleanField(null=True, default=False)
	age18 = models.NullBooleanField(null=True, default=False)
	arts = models.NullBooleanField(null=True, default=False)
	character = models.NullBooleanField(null=True, default=False)
	leadership = models.NullBooleanField(null=True, default=False)
	mentoring = models.NullBooleanField(null=True, default=False)
	nutrition = models.NullBooleanField(null=True, default=False)
	prevention = models.NullBooleanField(null=True, default=False)
	sports = models.NullBooleanField(null=True, default=False)
	supportservices = models.NullBooleanField(null=True, default=False)
	academic = models.NullBooleanField(null=True, default=False)
	community = models.NullBooleanField(null=True, default=False)
	monstartmorning = models.TimeField(null=True) 
	tuestartmorning = models.TimeField(null=True) 
	wedstartmorning = models.TimeField(null=True) 
	thustartmorning = models.TimeField(null=True) 
	fristartmorning = models.TimeField(null=True) 
	monendmorning   = models.TimeField(null=True) 
	tueendmorning   = models.TimeField(null=True) 
	wedendmorning   = models.TimeField(null=True) 
	thuendmorning   = models.TimeField(null=True) 
	friendmorning   = models.TimeField(null=True) 
	monstartafter   = models.TimeField(null=True) 
	tuestartafter    = models.TimeField(null=True)
	wedstartafter    = models.TimeField(null=True)
	thustartafter    = models.TimeField(null=True)
	fristartafter    = models.TimeField(null=True)
	monendafter      = models.TimeField(null=True)
	tueendafter      = models.TimeField(null=True)
	wedendafter      = models.TimeField(null=True)
	thuendafter      = models.TimeField(null=True)
	friendafter      = models.TimeField(null=True)
	satstartweekend  = models.TimeField(null=True)
	sunstartweekend  = models.TimeField(null=True)
	satendweekend    = models.TimeField(null=True)
	sunendweekend    = models.TimeField(null=True)
	monsummerstart   = models.TimeField(null=True)
	tuessummerstart  = models.TimeField(null=True)
	wedsummerstart   = models.TimeField(null=True)
	thurssummerstart = models.TimeField(null=True)
	frisummerstart   = models.TimeField(null=True)
	monsummerend     = models.TimeField(null=True)
	tuessummerend    = models.TimeField(null=True)
	wedsummerend     = models.TimeField(null=True)
	thurssummerend   = models.TimeField(null=True)
	frisummerend     = models.TimeField(null=True)
	charge           = models.NullBooleanField(null=True, default=False)
	costfrequency    = models.IntegerField(null=True)
	costamount       = models.DecimalField(null=True, max_digits=10, decimal_places=2)
	feeassistance    = models.NullBooleanField(null=True, default=False)
	desassistance    = models.NullBooleanField(null=True, default=False)
	scholarship      = models.NullBooleanField(null=True, default=False)
	mcdiscount       = models.NullBooleanField(null=True, default=False)
	otherassistance  = models.NullBooleanField(null=True, default=False)
	transportation   = models.NullBooleanField(null=True, default=False)
	snacks           = models.NullBooleanField(null=True, default=False)
	breakfast        = models.NullBooleanField(null=True, default=False)
	lunch            = models.NullBooleanField(null=True, default=False)
	dinner           = models.NullBooleanField(null=True, default=False)
	freelunch        = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	spanish          = models.NullBooleanField(null=True, default=False)
	otherlanguage    = models.NullBooleanField(null=True, default=False)
	verified         = models.IntegerField(null=True)
	siteid_old       = models.IntegerField(null=True)
	surveykey        = models.CharField(null=True,max_length=20)
	siteid_oldtemp   = models.IntegerField(null=True)
	stem             = models.NullBooleanField(null=True, default=False)
	college          = models.NullBooleanField(null=True, default=False)

	class Meta:
		db_table = 'azcase_sites'

	def getLocationObject(self):
		#gets location ID for the siteid
		locationObject = azcase_locations.objects.get(azcase_sites_locations_junction__siteid=self.siteid)
		return locationObject

	def getUserObject(self):
		#gets location ID for the siteid
		userObjects = azcase_users.objects.filter(azcase_user_sites_junction__siteid=self.siteid)
		return userObjects

	def getSurveyObject(self):
		#gets location ID for the siteid
		surveyObject = azcase_site_survey.objects.get(siteid__exact=self.siteid)
		return surveyObject

	def __unicode__(self):
		return self.name


class azcase_sites_form(ModelForm):
	class Meta:
		model = azcase_sites
		exclude = ['siteid', 'summercode']


class azcase_site_survey(models.Model):
	locationid = models.ForeignKey(azcase_locations, db_column="locationid")
	siteid = models.ForeignKey(azcase_sites, db_column="siteid")
	updated = models.DateTimeField(null=True, auto_now=True)
	capacity = models.IntegerField(null=True)
	atcapacity = models.NullBooleanField(null=True, default=False)
	served = models.IntegerField(null=True)
	costsame = models.NullBooleanField(null=True, default=False)
	slidescale = models.NullBooleanField(null=True, default=False)
	otherassistancedescription = models.TextField(null=True)
	transportcost = models.DecimalField(null=True, max_digits=10, decimal_places=2)
	fulltimestaff = models.DecimalField(null=True, max_digits=10, decimal_places=2)
	parttimestaff = models.DecimalField(null=True, max_digits=10, decimal_places=2)
	volunteerstaff = models.DecimalField(null=True, max_digits=10, decimal_places=2)
	workingstaff = models.DecimalField(null=True, max_digits=10, decimal_places=2)
	parentreferrals = models.NullBooleanField(null=True, default=False)
	parenteducation = models.NullBooleanField(null=True, default=False)
	parentinfo = models.NullBooleanField(null=True, default=False)
	parentotherdescription = models.TextField(null=True)
	africanamerican = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	asianamerican = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	white = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	latino = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	nativeamerican = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	otherrace = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	programtype = models.IntegerField(null=True)
	budgetfederal = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	budgetlocal = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	budgetfees = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	budgetgrant = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	budgetreligious = models.DecimalField(null=True, max_digits=5, decimal_places=2)
	barriersfull = models.IntegerField(null=True)
	barriersfulltext = models.TextField(null=True)
	fingerprint = models.NullBooleanField(null=True, default=False)
	drugtest = models.NullBooleanField(null=True, default=False)
	backgroundcheck = models.NullBooleanField(null=True, default=False)
	personalrefs = models.NullBooleanField(null=True, default=False)
	othercheck = models.NullBooleanField(null=True, default=False)
	prodevelop = models.IntegerField(null=True)
	prodevelophours = models.IntegerField(null=True)
	prodevelop_rankmost1 = models.IntegerField(null=True)
	prodevelop_rank2 = models.IntegerField(null=True)
	prodevelop_rank3 = models.IntegerField(null=True)
	prodevelop_rank4 = models.IntegerField(null=True)
	prodevelop_rankleast5 = models.IntegerField(null=True)
	training_ownstaff = models.NullBooleanField(null=True, default=False)
	training_aascc = models.NullBooleanField(null=True, default=False)
	training_azcase = models.NullBooleanField(null=True, default=False)
	training_azdhs = models.NullBooleanField(null=True, default=False)
	training_naa = models.NullBooleanField(null=True, default=False)
	training_niost = models.NullBooleanField(null=True, default=False)
	training_shd = models.NullBooleanField(null=True, default=False)
	training_other = models.TextField(null=True)
	training_needs = models.IntegerField(null=True)
	training_needsother = models.TextField(null=True)
	training_needssecond = models.IntegerField(null=True)
	training_needssecond_other = models.TextField(null=True)
	evaluate_program = models.NullBooleanField(null=True, default=False)
	evaluate_type = models.IntegerField(null=True)
	youth_planactivity = models.IntegerField(null=True)
	youth_makerules = models.IntegerField(null=True)
	collab_school = models.NullBooleanField(null=True, default=False)
	collab_schoolfreq = models.IntegerField(null=True)
	surveykey = models.CharField(null=True,max_length=20)

	class Meta:
		db_table = 'azcase_site_survey'


class azcase_users(models.Model):
	userid = models.IntegerField(null=False, primary_key=True)
	useremail = models.CharField(null=False, max_length=200)
	username = models.CharField(null=True,max_length=200)
	password = models.CharField(null=True,max_length=32)
	admin = models.NullBooleanField(null=True, default=False)
	firstlogin = models.NullBooleanField(null=True, default=False)
	lastlogintime = models.TimeField(null=True) 
	updated = models.DateTimeField(null=True, auto_now=True) 
	orgname = models.CharField(null=True,max_length=500)
	address = models.CharField(null=True,max_length=500)
	address2 = models.CharField(null=True,max_length=500)
	city = models.CharField(null=True,max_length=50)
	state = models.CharField(null=True,max_length=2)
	zip = models.CharField(null=True,max_length=10)
	phone = models.CharField(null=True,max_length=50)
	fax = models.CharField(null=True,max_length=50)
	temp_pass = models.CharField(null=True,max_length=32)
	renewalemail = models.TimeField(null=True) 

	class Meta:
		db_table = 'azcase_users'

	def __unicode__(self):
		return self.useremail



class azcase_sites_locations_junction(models.Model):
	siteid = models.ForeignKey(azcase_sites, db_column="siteid")
	locationid = models.ForeignKey(azcase_locations, db_column="locationid")
	wp_pledge_id = models.IntegerField(null=True)

	class Meta:
		db_table = 'azcase_sites_locations_junction'


class azcase_user_locations_junction(models.Model):
	userid = models.ForeignKey(azcase_users, db_column="userid")
	locationid = models.ForeignKey(azcase_locations, db_column="locationid")

	class Meta:
		db_table = 'azcase_user_locations_junction'


class azcase_user_sites_junction(models.Model):
	userid = models.ForeignKey(azcase_users, db_column="userid")
	siteid = models.ForeignKey(azcase_sites, db_column="siteid")
	newsite = models.NullBooleanField(null=True, default=False)

	class Meta:
		db_table = 'azcase_user_sites_junction'

class azcase_sites_duplicates(models.Model):
	siteid1 = models.ForeignKey(azcase_sites, related_name="siteid1")
	siteid2 = models.ForeignKey(azcase_sites, related_name="siteid2")
	notDuplicate = models.BooleanField(default=False)

class azcase_users_duplicates(models.Model):
	userid1 = models.ForeignKey(azcase_users, related_name="userid1")
	userid2 = models.ForeignKey(azcase_users, related_name="userid2")
	notDuplicate = models.BooleanField(default=False)

class azcase_locations_duplicates(models.Model):
	locationid1 = models.ForeignKey(azcase_locations, related_name="locationid1")
	locationid2 = models.ForeignKey(azcase_locations, related_name="locationid2")
	notDuplicate = models.BooleanField(default=False)


class azcase_publicadvancedsearch(models.Model):
	gid = models.IntegerField(null=False, primary_key=True)
	azcongress = models.NullBooleanField(null=True, default=False)
	stateleg            = models.NullBooleanField(null=True, default=False)
	elemschooldistrict  = models.NullBooleanField(null=True, default=False)
	unionschooldistrict = models.NullBooleanField(null=True, default=False)
	city                = models.NullBooleanField(null=True, default=False)
	activity            = models.NullBooleanField(null=True, default=False)
	ages                = models.NullBooleanField(null=True, default=False)
	summer              = models.NullBooleanField(null=True, default=False)
	summary1            = models.NullBooleanField(null=True, default=False)
	cd1                 = models.NullBooleanField(null=True, default=False)
	sld1                = models.NullBooleanField(null=True, default=False)
	elm1                = models.NullBooleanField(null=True, default=False)
	union1              = models.NullBooleanField(null=True, default=False)
	city1               = models.NullBooleanField(null=True, default=False)
	activity1           = models.NullBooleanField(null=True, default=False)
	ages1               = models.NullBooleanField(null=True, default=False)
	summary3            = models.NullBooleanField(null=True, default=False)
	cd3                 = models.NullBooleanField(null=True, default=False)
	sld3                = models.NullBooleanField(null=True, default=False)
	elm3                = models.NullBooleanField(null=True, default=False)
	union3              = models.NullBooleanField(null=True, default=False)
	city3               = models.NullBooleanField(null=True, default=False)
	activity3           = models.NullBooleanField(null=True, default=False)
	ages3               = models.NullBooleanField(null=True, default=False)
	summary4            = models.NullBooleanField(null=True, default=False)
	cd4                 = models.NullBooleanField(null=True, default=False)
	sld4                = models.NullBooleanField(null=True, default=False)
	elm4                = models.NullBooleanField(null=True, default=False)
	union4              = models.NullBooleanField(null=True, default=False)
	city4               = models.NullBooleanField(null=True, default=False)
	activity4           = models.NullBooleanField(null=True, default=False)
	ages4               = models.NullBooleanField(null=True, default=False)
	summary5            = models.NullBooleanField(null=True, default=False)
	cd5                 = models.NullBooleanField(null=True, default=False)
	sld5                = models.NullBooleanField(null=True, default=False)
	elm5                = models.NullBooleanField(null=True, default=False)
	union5              = models.NullBooleanField(null=True, default=False)
	city5               = models.NullBooleanField(null=True, default=False)
	activity5           = models.NullBooleanField(null=True, default=False)
	ages5               = models.NullBooleanField(null=True, default=False)
	summary6            = models.NullBooleanField(null=True, default=False)
	cd6                 = models.NullBooleanField(null=True, default=False)
	sld6                = models.NullBooleanField(null=True, default=False)
	elm6                = models.NullBooleanField(null=True, default=False)
	union6              = models.NullBooleanField(null=True, default=False)
	city6               = models.NullBooleanField(null=True, default=False)
	activity6           = models.NullBooleanField(null=True, default=False)
	ages6               = models.NullBooleanField(null=True, default=False)
	summary7            = models.NullBooleanField(null=True, default=False)
	cd7                 = models.NullBooleanField(null=True, default=False)
	sld7                = models.NullBooleanField(null=True, default=False)
	elm7                = models.NullBooleanField(null=True, default=False)
	union7              = models.NullBooleanField(null=True, default=False)
	city7               = models.NullBooleanField(null=True, default=False)
	activity7           = models.NullBooleanField(null=True, default=False)
	ages7               = models.NullBooleanField(null=True, default=False)
	summary8            = models.NullBooleanField(null=True, default=False)
	cd8                 = models.NullBooleanField(null=True, default=False)
	sld8                = models.NullBooleanField(null=True, default=False)
	elm8                = models.NullBooleanField(null=True, default=False)
	union8              = models.NullBooleanField(null=True, default=False)
	city8               = models.NullBooleanField(null=True, default=False)
	activity8           = models.NullBooleanField(null=True, default=False)
	ages8               = models.NullBooleanField(null=True, default=False)
	summary9            = models.NullBooleanField(null=True, default=False)
	cd9                 = models.NullBooleanField(null=True, default=False)
	sld9                = models.NullBooleanField(null=True, default=False)
	elm9                = models.NullBooleanField(null=True, default=False)
	union9              = models.NullBooleanField(null=True, default=False)
	city9               = models.NullBooleanField(null=True, default=False)
	activity9           = models.NullBooleanField(null=True, default=False)
	ages9               = models.NullBooleanField(null=True, default=False)
	summary10           = models.NullBooleanField(null=True, default=False)
	cd10                = models.NullBooleanField(null=True, default=False)
	sld10               = models.NullBooleanField(null=True, default=False)
	elm10               = models.NullBooleanField(null=True, default=False)
	union10             = models.NullBooleanField(null=True, default=False)
	city10              = models.NullBooleanField(null=True, default=False)
	activity10          = models.NullBooleanField(null=True, default=False)
	ages10              = models.NullBooleanField(null=True, default=False)
	summary11           = models.NullBooleanField(null=True, default=False)
	cd11                = models.NullBooleanField(null=True, default=False)
	sld11               = models.NullBooleanField(null=True, default=False)
	elm11               = models.NullBooleanField(null=True, default=False)
	union11             = models.NullBooleanField(null=True, default=False)
	city11              = models.NullBooleanField(null=True, default=False)
	activity11          = models.NullBooleanField(null=True, default=False)
	ages11              = models.NullBooleanField(null=True, default=False)
	summary12           = models.NullBooleanField(null=True, default=False)
	cd12                = models.NullBooleanField(null=True, default=False)
	sld12               = models.NullBooleanField(null=True, default=False)
	elm12               = models.NullBooleanField(null=True, default=False)
	union12             = models.NullBooleanField(null=True, default=False)
	city12              = models.NullBooleanField(null=True, default=False)
	activity12          = models.NullBooleanField(null=True, default=False)
	ages12              = models.NullBooleanField(null=True, default=False)
	summary13           = models.NullBooleanField(null=True, default=False)
	cd13                = models.NullBooleanField(null=True, default=False)
	sld13               = models.NullBooleanField(null=True, default=False)
	elm13               = models.NullBooleanField(null=True, default=False)
	union13             = models.NullBooleanField(null=True, default=False)
	city13              = models.NullBooleanField(null=True, default=False)
	activity13          = models.NullBooleanField(null=True, default=False)
	ages13              = models.NullBooleanField(null=True, default=False)
	summary14           = models.NullBooleanField(null=True, default=False)
	cd14                = models.NullBooleanField(null=True, default=False)
	sld14               = models.NullBooleanField(null=True, default=False)
	elm14               = models.NullBooleanField(null=True, default=False)
	union14             = models.NullBooleanField(null=True, default=False)
	city14              = models.NullBooleanField(null=True, default=False)
	activity14          = models.NullBooleanField(null=True, default=False)
	ages14              = models.NullBooleanField(null=True, default=False)
	summary15           = models.NullBooleanField(null=True, default=False)
	cd15                = models.NullBooleanField(null=True, default=False)
	sld15               = models.NullBooleanField(null=True, default=False)
	elm15               = models.NullBooleanField(null=True, default=False)
	union15             = models.NullBooleanField(null=True, default=False)
	city15              = models.NullBooleanField(null=True, default=False)
	activity15          = models.NullBooleanField(null=True, default=False)
	ages15              = models.NullBooleanField(null=True, default=False)

	class Meta:
		db_table = 'azcase_publicadvancedsearch'


