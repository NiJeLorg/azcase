from django.contrib import admin

# Register your models here.
from azcase_admin.models import *

admin.site.register(azcase_locations)
admin.site.register(azcase_sites)
admin.site.register(azcase_site_survey)
admin.site.register(azcase_users)
admin.site.register(azcase_sites_locations_junction)
admin.site.register(azcase_user_locations_junction)
admin.site.register(azcase_user_sites_junction)
admin.site.register(azcase_publicadvancedsearch)
admin.site.register(azcase_locations_duplicates)
admin.site.register(azcase_users_duplicates)
admin.site.register(azcase_sites_duplicates)
