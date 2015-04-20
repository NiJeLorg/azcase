# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('azcase_admin', '0004_auto_20150317_2103'),
    ]

    operations = [
        migrations.AlterField(
            model_name='azcase_site_survey',
            name='locationid',
            field=models.ForeignKey(to='azcase_admin.azcase_locations', db_column=b'locationid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_site_survey',
            name='siteid',
            field=models.ForeignKey(to='azcase_admin.azcase_sites', db_column=b'siteid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_sites_locations_junction',
            name='locationid',
            field=models.ForeignKey(to='azcase_admin.azcase_locations', db_column=b'locationid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_sites_locations_junction',
            name='siteid',
            field=models.ForeignKey(to='azcase_admin.azcase_sites', db_column=b'siteid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_user_locations_junction',
            name='locationid',
            field=models.ForeignKey(to='azcase_admin.azcase_locations', db_column=b'locationid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_user_locations_junction',
            name='userid',
            field=models.ForeignKey(to='azcase_admin.azcase_users', db_column=b'userid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_user_sites_junction',
            name='siteid',
            field=models.ForeignKey(to='azcase_admin.azcase_sites', db_column=b'siteid'),
            preserve_default=True,
        ),
        migrations.AlterField(
            model_name='azcase_user_sites_junction',
            name='userid',
            field=models.ForeignKey(to='azcase_admin.azcase_users', db_column=b'userid'),
            preserve_default=True,
        ),
    ]
