Create a WordPress plugin named “DogPages” that allows the user to add a page to their website with a single picture of a dog.

- Add settings to admin sidebar named “DogPages”. This should allow to upload a picture of a dog that will be shown on the public page
- ?When a site has a dog picture uploaded, make it so the routes loads this dog picture when going to path “/dog”. This will be public accessible
- ?Require a license key: When installing the plugin for the first time or when a key is not loaded, prompt the users in the admin settings page to add a license key. This should be stored (we don’t require to send this to any server)
- ?Add a sample cron to check the license key daily at 12am. This can just output to the log “Checked license key”. You do not need to add the API calls
- ?Add multisite support: when multisite is enabled, you should be able to assign a dog per site. When accessing “/dog” on that site, it will load the dog photo for that site