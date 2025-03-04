<h1>Laravel Blog</h1>
Laravel Blog is Laravel Blog sample application. 

<h2>Installation / Configure</h2>
<ul>
    <li>Open terminal and run the following commands:
        <ul>
            <li>composer install / composer update</li>
            <li>cp .env.example .env</li>
            <li>update DB and MAIL varibales in `.env` file</li>
            <li>php artisan migrate</li>
            <li>php artisan db:seed</li>
            <li>php artisan storage:link</li>
            <li>As it happens with laravel app at local like sometimes changes are not visible at browser so try `php artisan optimize`, `php artisan config:clear`, `php artisan cache:clear` etc..</li>
        </ul>
    </li>
</ul>

<h2>User Login Credential</h2>
<ul>
    <li><strong>Agent:</strong> email; link2ismail@gmail.com | password: link2ismail</li>
</ul>

<h2>Note:</h2>
There are some points under progress like user `profile show` and `seeder` classes `images upload` via image faker although its working fine but if a i change the directory it doesnt work 
