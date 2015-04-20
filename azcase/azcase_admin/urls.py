from django.conf.urls import patterns, include, url
from azcase_admin import views

urlpatterns = patterns('',
    url(r'^$', views.index, name='index'),
    url(r'^programs/$', views.sitesUsersLocations, name='programs'),
    url(r'^users/$', views.sitesUsersLocations, name='users'),
    url(r'^locations/$', views.sitesUsersLocations, name='locations'),
    url(r'^filterSites/$', views.filterSites, name='filterSites'),
    url(r'^filterUsers/$', views.filterUsers, name='filterUsers'),
    url(r'^filterLocations/$', views.filterLocations, name='filterLocations'),
    url(r'^addPrograms/$', views.addPrograms, name='addPrograms'),
    url(r'^addUsers/$', views.addUsers, name='addUsers'),
    url(r'^addLocations/$', views.addLocations, name='addLocations'),
    url(r'^downloadData/$', views.downloadData, name='downloadData'),
    url(r'^editPrograms/$', views.editPrograms, name='editPrograms'),
    url(r'^editUsers/$', views.editUsers, name='editUsers'),
    url(r'^editLocations/$', views.editLocations, name='editLocations'),
    url(r'^verifyPrograms/$', views.verifyPrograms, name='verifyPrograms'),
)
