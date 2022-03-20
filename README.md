
How would you handle rate limiting?

caching the api results to limit requests.
spread the time between requests. 
make sure you are accessing all the data needed with the minimal requests, for example if we could get the GitHub users and the repositories in one request that would significantly improve my implementations performance and prevent hitting an api rate limit.
If the api uses server rate limiting you could run the implementation across several servers and split the user load between them.

How would you handle fundamental errors, such as an API being down?

If the API its self is down caching should be able to return a response till it times out. If the API is still down are your caching has timed out you should have precautions in place to let the user know that this specific service is down rather than crash the site. Using micro services would be one one to prevent this from affecting the rest of the system.
If the API is not down you should still have a retry pattern implemented to prevent random errors from internet connectivity or a corrupted payload. 
You should also fully validate the payload before it is sent to the user be be confident that it will return the correct data.

If building for scale, what would you implement to optimise performance for the end user?

Caching to limit DB & API requests.
Queues to prevent the server from overloading on too many tasks at the same time.
Removing any used packages. 
Only fetch fields needed from db queries. So replace a ‘select * from users’ query with a ‘’select name, email from users’ query.

What tooling could you use to implement testing?

PHPUnit for unit tests & a test driven development.
The web application known as WebLOAD to signify the load handling capability of the application.

If this tool was frequently updated by a team, how would you manage version control?

It is always good practice to make sure your application/website is up to date with all the languages and packages it is using. 
I would suggest to update them as frequently as possible to prevent large conflicts if any at all.
I would then suggest to fully test the updates in as many environments as possible before committing these changes.

Git practices I would follow whilst updating these tools/packages would be feature branches so you have a history on where these updates where
made and can rollback if needed.
