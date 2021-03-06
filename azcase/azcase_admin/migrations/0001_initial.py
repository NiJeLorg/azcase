# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models, migrations


class Migration(migrations.Migration):

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='azcase_locations',
            fields=[
                ('locationid', models.IntegerField(serialize=False, primary_key=True)),
                ('updated', models.TimeField()),
                ('name', models.CharField(max_length=500)),
                ('namesp', models.CharField(max_length=500)),
                ('address', models.CharField(max_length=500)),
                ('address2', models.CharField(max_length=500)),
                ('city', models.CharField(max_length=50)),
                ('state', models.CharField(max_length=2)),
                ('zip', models.CharField(max_length=10)),
                ('lat', models.DecimalField(max_digits=12, decimal_places=8)),
                ('lon', models.DecimalField(max_digits=12, decimal_places=8)),
                ('surveykey', models.CharField(max_length=20)),
                ('the_geom', models.CharField(max_length=500)),
            ],
            options={
                'db_table': 'azcase_locations',
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_publicadvancedsearch',
            fields=[
                ('gid', models.IntegerField(serialize=False, primary_key=True)),
                ('azcongress', models.BooleanField()),
                ('stateleg', models.BooleanField()),
                ('elemschooldistrict', models.BooleanField()),
                ('unionschooldistrict', models.BooleanField()),
                ('city', models.BooleanField()),
                ('activity', models.BooleanField()),
                ('ages', models.BooleanField()),
                ('summer', models.BooleanField()),
                ('summary1', models.BooleanField()),
                ('cd1', models.BooleanField()),
                ('sld1', models.BooleanField()),
                ('elm1', models.BooleanField()),
                ('union1', models.BooleanField()),
                ('city1', models.BooleanField()),
                ('activity1', models.BooleanField()),
                ('ages1', models.BooleanField()),
                ('summary3', models.BooleanField()),
                ('cd3', models.BooleanField()),
                ('sld3', models.BooleanField()),
                ('elm3', models.BooleanField()),
                ('union3', models.BooleanField()),
                ('city3', models.BooleanField()),
                ('activity3', models.BooleanField()),
                ('ages3', models.BooleanField()),
                ('summary4', models.BooleanField()),
                ('cd4', models.BooleanField()),
                ('sld4', models.BooleanField()),
                ('elm4', models.BooleanField()),
                ('union4', models.BooleanField()),
                ('city4', models.BooleanField()),
                ('activity4', models.BooleanField()),
                ('ages4', models.BooleanField()),
                ('summary5', models.BooleanField()),
                ('cd5', models.BooleanField()),
                ('sld5', models.BooleanField()),
                ('elm5', models.BooleanField()),
                ('union5', models.BooleanField()),
                ('city5', models.BooleanField()),
                ('activity5', models.BooleanField()),
                ('ages5', models.BooleanField()),
                ('summary6', models.BooleanField()),
                ('cd6', models.BooleanField()),
                ('sld6', models.BooleanField()),
                ('elm6', models.BooleanField()),
                ('union6', models.BooleanField()),
                ('city6', models.BooleanField()),
                ('activity6', models.BooleanField()),
                ('ages6', models.BooleanField()),
                ('summary7', models.BooleanField()),
                ('cd7', models.BooleanField()),
                ('sld7', models.BooleanField()),
                ('elm7', models.BooleanField()),
                ('union7', models.BooleanField()),
                ('city7', models.BooleanField()),
                ('activity7', models.BooleanField()),
                ('ages7', models.BooleanField()),
                ('summary8', models.BooleanField()),
                ('cd8', models.BooleanField()),
                ('sld8', models.BooleanField()),
                ('elm8', models.BooleanField()),
                ('union8', models.BooleanField()),
                ('city8', models.BooleanField()),
                ('activity8', models.BooleanField()),
                ('ages8', models.BooleanField()),
                ('summary9', models.BooleanField()),
                ('cd9', models.BooleanField()),
                ('sld9', models.BooleanField()),
                ('elm9', models.BooleanField()),
                ('union9', models.BooleanField()),
                ('city9', models.BooleanField()),
                ('activity9', models.BooleanField()),
                ('ages9', models.BooleanField()),
                ('summary10', models.BooleanField()),
                ('cd10', models.BooleanField()),
                ('sld10', models.BooleanField()),
                ('elm10', models.BooleanField()),
                ('union10', models.BooleanField()),
                ('city10', models.BooleanField()),
                ('activity10', models.BooleanField()),
                ('ages10', models.BooleanField()),
                ('summary11', models.BooleanField()),
                ('cd11', models.BooleanField()),
                ('sld11', models.BooleanField()),
                ('elm11', models.BooleanField()),
                ('union11', models.BooleanField()),
                ('city11', models.BooleanField()),
                ('activity11', models.BooleanField()),
                ('ages11', models.BooleanField()),
                ('summary12', models.BooleanField()),
                ('cd12', models.BooleanField()),
                ('sld12', models.BooleanField()),
                ('elm12', models.BooleanField()),
                ('union12', models.BooleanField()),
                ('city12', models.BooleanField()),
                ('activity12', models.BooleanField()),
                ('ages12', models.BooleanField()),
                ('summary13', models.BooleanField()),
                ('cd13', models.BooleanField()),
                ('sld13', models.BooleanField()),
                ('elm13', models.BooleanField()),
                ('union13', models.BooleanField()),
                ('city13', models.BooleanField()),
                ('activity13', models.BooleanField()),
                ('ages13', models.BooleanField()),
                ('summary14', models.BooleanField()),
                ('cd14', models.BooleanField()),
                ('sld14', models.BooleanField()),
                ('elm14', models.BooleanField()),
                ('union14', models.BooleanField()),
                ('city14', models.BooleanField()),
                ('activity14', models.BooleanField()),
                ('ages14', models.BooleanField()),
                ('summary15', models.BooleanField()),
                ('cd15', models.BooleanField()),
                ('sld15', models.BooleanField()),
                ('elm15', models.BooleanField()),
                ('union15', models.BooleanField()),
                ('city15', models.BooleanField()),
                ('activity15', models.BooleanField()),
                ('ages15', models.BooleanField()),
            ],
            options={
                'db_table': 'azcase_publicadvancedsearch',
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_site_survey',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('updated', models.TimeField()),
                ('capacity', models.IntegerField()),
                ('atcapacity', models.BooleanField()),
                ('served', models.IntegerField()),
                ('costsame', models.BooleanField()),
                ('slidescale', models.BooleanField()),
                ('otherassistancedescription', models.TextField()),
                ('transportcost', models.DecimalField(max_digits=10, decimal_places=2)),
                ('fulltimestaff', models.DecimalField(max_digits=10, decimal_places=2)),
                ('parttimestaff', models.DecimalField(max_digits=10, decimal_places=2)),
                ('volunteerstaff', models.DecimalField(max_digits=10, decimal_places=2)),
                ('workingstaff', models.DecimalField(max_digits=10, decimal_places=2)),
                ('parentreferrals', models.BooleanField()),
                ('parenteducation', models.BooleanField()),
                ('parentinfo', models.BooleanField()),
                ('parentotherdescription', models.TextField()),
                ('africanamerican', models.DecimalField(max_digits=5, decimal_places=2)),
                ('asianamerican', models.DecimalField(max_digits=5, decimal_places=2)),
                ('white', models.DecimalField(max_digits=5, decimal_places=2)),
                ('latino', models.DecimalField(max_digits=5, decimal_places=2)),
                ('nativeamerican', models.DecimalField(max_digits=5, decimal_places=2)),
                ('otherrace', models.DecimalField(max_digits=5, decimal_places=2)),
                ('programtype', models.IntegerField()),
                ('budgetfederal', models.DecimalField(max_digits=5, decimal_places=2)),
                ('budgetlocal', models.DecimalField(max_digits=5, decimal_places=2)),
                ('budgetfees', models.DecimalField(max_digits=5, decimal_places=2)),
                ('budgetgrant', models.DecimalField(max_digits=5, decimal_places=2)),
                ('budgetreligious', models.DecimalField(max_digits=5, decimal_places=2)),
                ('barriersfull', models.IntegerField()),
                ('barriersfulltext', models.TextField()),
                ('fingerprint', models.BooleanField()),
                ('drugtest', models.BooleanField()),
                ('backgroundcheck', models.BooleanField()),
                ('personalrefs', models.BooleanField()),
                ('othercheck', models.BooleanField()),
                ('prodevelop', models.IntegerField()),
                ('prodevelophours', models.IntegerField()),
                ('prodevelop_rankmost1', models.IntegerField()),
                ('prodevelop_rank2', models.IntegerField()),
                ('prodevelop_rank3', models.IntegerField()),
                ('prodevelop_rank4', models.IntegerField()),
                ('prodevelop_rankleast5', models.IntegerField()),
                ('training_ownstaff', models.BooleanField()),
                ('training_aascc', models.BooleanField()),
                ('training_azcase', models.BooleanField()),
                ('training_azdhs', models.BooleanField()),
                ('training_naa', models.BooleanField()),
                ('training_niost', models.BooleanField()),
                ('training_shd', models.BooleanField()),
                ('training_other', models.TextField()),
                ('training_needs', models.IntegerField()),
                ('training_needsother', models.TextField()),
                ('training_needssecond', models.IntegerField()),
                ('training_needssecond_other', models.TextField()),
                ('evaluate_program', models.BooleanField()),
                ('evaluate_type', models.IntegerField()),
                ('youth_planactivity', models.IntegerField()),
                ('youth_makerules', models.IntegerField()),
                ('collab_school', models.BooleanField()),
                ('collab_schoolfreq', models.IntegerField()),
                ('surveykey', models.CharField(max_length=20)),
                ('locationid', models.ForeignKey(to='azcase_admin.azcase_locations')),
            ],
            options={
                'db_table': 'azcase_site_survey',
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_sites',
            fields=[
                ('siteid', models.IntegerField(serialize=False, primary_key=True)),
                ('updated', models.TimeField()),
                ('name', models.CharField(max_length=500)),
                ('namesp', models.CharField(max_length=500)),
                ('phone', models.CharField(max_length=50)),
                ('fax', models.CharField(max_length=50)),
                ('email', models.CharField(max_length=200)),
                ('pubemail', models.BooleanField()),
                ('url', models.CharField(max_length=200)),
                ('summer', models.BooleanField()),
                ('summercode', models.IntegerField()),
                ('age5', models.BooleanField()),
                ('age6', models.BooleanField()),
                ('age7', models.BooleanField()),
                ('age8', models.BooleanField()),
                ('age9', models.BooleanField()),
                ('age10', models.BooleanField()),
                ('age11', models.BooleanField()),
                ('age12', models.BooleanField()),
                ('age13', models.BooleanField()),
                ('age14', models.BooleanField()),
                ('age15', models.BooleanField()),
                ('age16', models.BooleanField()),
                ('age17', models.BooleanField()),
                ('age18', models.BooleanField()),
                ('arts', models.BooleanField()),
                ('character', models.BooleanField()),
                ('leadership', models.BooleanField()),
                ('mentoring', models.BooleanField()),
                ('nutrition', models.BooleanField()),
                ('prevention', models.BooleanField()),
                ('sports', models.BooleanField()),
                ('supportservices', models.BooleanField()),
                ('academic', models.BooleanField()),
                ('community', models.BooleanField()),
                ('monstartmorning', models.TimeField()),
                ('tuestartmorning', models.TimeField()),
                ('wedstartmorning', models.TimeField()),
                ('thustartmorning', models.TimeField()),
                ('fristartmorning', models.TimeField()),
                ('monendmorning', models.TimeField()),
                ('tueendmorning', models.TimeField()),
                ('wedendmorning', models.TimeField()),
                ('thuendmorning', models.TimeField()),
                ('friendmorning', models.TimeField()),
                ('monstartafter', models.TimeField()),
            ],
            options={
                'db_table': 'azcase_sites',
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_sites_locations_junction',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('locationid', models.ForeignKey(to='azcase_admin.azcase_locations')),
                ('siteid', models.ForeignKey(to='azcase_admin.azcase_sites')),
            ],
            options={
                'db_table': 'azcase_sites_locations_junction',
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_user_locations_junction',
            fields=[
                ('id', models.AutoField(verbose_name='ID', serialize=False, auto_created=True, primary_key=True)),
                ('locationid', models.ForeignKey(to='azcase_admin.azcase_locations')),
            ],
            options={
                'db_table': 'azcase_user_locations_junction',
            },
            bases=(models.Model,),
        ),
        migrations.CreateModel(
            name='azcase_users',
            fields=[
                ('userid', models.IntegerField(serialize=False, primary_key=True)),
                ('useremail', models.CharField(max_length=200)),
                ('username', models.CharField(max_length=200)),
                ('password', models.CharField(max_length=32)),
                ('admin', models.BooleanField()),
                ('firstlogin', models.BooleanField()),
                ('lastlogintime', models.TimeField()),
                ('updated', models.TimeField()),
                ('orgname', models.CharField(max_length=500)),
                ('address', models.CharField(max_length=500)),
                ('address2', models.CharField(max_length=500)),
                ('city', models.CharField(max_length=50)),
                ('state', models.CharField(max_length=2)),
                ('zip', models.CharField(max_length=10)),
                ('phone', models.CharField(max_length=50)),
                ('fax', models.CharField(max_length=50)),
                ('temp_pass', models.CharField(max_length=32)),
                ('renewalemail', models.TimeField()),
            ],
            options={
                'db_table': 'azcase_users',
            },
            bases=(models.Model,),
        ),
        migrations.AddField(
            model_name='azcase_user_locations_junction',
            name='userid',
            field=models.ForeignKey(to='azcase_admin.azcase_users'),
            preserve_default=True,
        ),
        migrations.AddField(
            model_name='azcase_site_survey',
            name='siteid',
            field=models.ForeignKey(to='azcase_admin.azcase_sites'),
            preserve_default=True,
        ),
    ]
