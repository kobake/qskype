#/bin/sh

script_dir=$(cd $(dirname ${BASH_SOURCE:-$0}); pwd)
# echo $script_dir

chmod -R a+rwX "$script_dir/web/app/tmp"
chmod -R a+rwX "$script_dir/web/app/Data"

# chmod -R 777 ./web/app/tmp
# chmod -R a+rwX /home/www/localhost/public_html/qskype/web/app/tmp



