# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('azcase_admin', '0005_auto_20150317_2115'),
    ]

    operations = [
        migrations.AddField(
            model_name='azcase_sites_locations_junction',
            name='wp_pledge_id',
            field=models.IntegerField(null=True),
            preserve_default=True,
        ),
    ]
