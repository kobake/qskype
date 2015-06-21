#!/bin/sh
rm Config/Migration/*
rm Config/Schema/schema.php
rm tmp/cache/models/myapp_*
rm tmp/cache/persistent/myapp_*
echo "drop table schema_migrations;" | mysql -u sop2 -psop2 sop2

