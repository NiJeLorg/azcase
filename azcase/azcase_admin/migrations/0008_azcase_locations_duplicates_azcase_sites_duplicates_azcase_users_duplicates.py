# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
        ('azcase_admin', '0007_auto_20150406_0156'),
    ]

    operations = [
        migrations.CreateModel(
            name='azcase_locations_duplicates',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('notDuplicate', models.BooleanField(default=False)),
                ('locationid1', models.ForeignKey(related_name='locationid1', to='azcase_admin.azcase_locations')),
                ('locationid2', models.ForeignKey(related_name='locationid2', to='azcase_admin.azcase_locations')),
            ],
            options={
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_sites_duplicates',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('notDuplicate', models.BooleanField(default=False)),
                ('siteid1', models.ForeignKey(related_name='siteid1', to='azcase_admin.azcase_sites')),
                ('siteid2', models.ForeignKey(related_name='siteid2', to='azcase_admin.azcase_sites')),
            ],
            options={
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_users_duplicates',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('notDuplicate', models.BooleanField(default=False)),
                ('userid1', models.ForeignKey(related_name='userid1', to='azcase_admin.azcase_users')),
                ('userid2', models.ForeignKey(related_name='userid2', to='azcase_admin.azcase_users')),
            ],
            options={
            },
            bases=(models.Model,),
        ),
    ]
