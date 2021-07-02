### Demo Credentials

**Admin:** admin@admin.com  
**Password:** secret

### Security Vulnerabilities

If you discover a security vulnerability within this boilerplate, please send an e-mail to andhikafatoni@gmail.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.

## Known bugs
### installing on nginx with proxypass
  add this line inside boot() on AppServiceProvide to force the routing
  ```
    \URL::forceRootUrl('https://domain.com');
    \URL::forceScheme('https');
  ```
  