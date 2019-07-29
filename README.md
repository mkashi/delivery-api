# delivery-api

###  add dependencies

add `new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),` to the AppKernel.php 

### then add to your configuration.

    stof_doctrine_extensions:
        default_locale: '%locale%'
        orm:
            default: 
              sluggable: true
