from django.contrib import admin

# Register your models here.
from azcase_admin.models import azcase_locations
from azcase_admin.models import azcase_sites
from azcase_admin.models import azcase_site_survey
from azcase_admin.models import azcase_users
from azcase_admin.models import azcase_sites_locations_junction
from azcase_admin.models import azcase_user_locations_junction
from azcase_admin.models import azcase_user_sites_junction
from azcase_admin.models import azcase_publicadvancedsearch

admin.site.register(azcase_locations)
admin.site.register(azcase_sites)
admin.site.register(azcase_site_survey)
admin.site.register(azcase_users)
admin.site.register(azcase_sites_locations_junction)
admin.site.register(azcase_user_locations_junction)
admin.site.register(azcase_user_sites_junction)
admin.site.register(azcase_publicadvancedsearch)
