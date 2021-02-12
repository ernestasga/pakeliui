# Pakeliui.lt

## Deployment
* Setup .env
* Add entry to CRON JOBS:
    >php artisan schedule:run
* Edit index.php to point to public_html
* Check GenerateSitemap command to point to public_html
* Run migration and seed database
    > php artisan migrate
    
    > php artisan db:seed

