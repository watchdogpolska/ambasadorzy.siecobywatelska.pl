# -*- coding: utf-8 -*-
"""
Django settings for ankieta project.

For more information on this file, see
https://docs.djangoproject.com/en/dev/topics/settings/

For the full list of settings and their values, see
https://docs.djangoproject.com/en/dev/ref/settings/
"""

# Build paths inside the project like this: os.path.join(BASE_DIR, ...)
import os
from os.path import join, dirname

from configurations import Configuration, values

BASE_DIR = dirname(dirname(__file__))


class Common(Configuration):

    # APP CONFIGURATION
    DJANGO_APPS = (
        # Default Django apps:
        'django.contrib.auth',
        'django.contrib.contenttypes',
        'django.contrib.sessions',
        'django.contrib.sites',
        'django.contrib.messages',
        'django.contrib.staticfiles',

        # Useful template tags:
        # 'django.contrib.humanize',
        'django.contrib.flatpages',
        'django.contrib.webdesign',
        # Admin
        'django.contrib.admin',
    )
    THIRD_PARTY_APPS = (
        'crispy_forms',  # Form layouts
        'constance',
        'constance.backends.database',
        'import_export',  # required by django-one-petition
        'petition',
        'contact',
    )

    # Apps specific for this project go here.
    LOCAL_APPS = (
        'users',  # custom users app
        # Your stuff: custom apps go here
    )

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#installed-apps
    INSTALLED_APPS = DJANGO_APPS + THIRD_PARTY_APPS + LOCAL_APPS
    # END APP CONFIGURATION

    # MIDDLEWARE CONFIGURATION
    MIDDLEWARE_CLASSES = (
        # Make sure djangosecure.middleware.SecurityMiddleware is listed first
        'django.contrib.sessions.middleware.SessionMiddleware',
        'django.middleware.common.CommonMiddleware',
        'django.middleware.csrf.CsrfViewMiddleware',
        'django.contrib.auth.middleware.AuthenticationMiddleware',
        'django.contrib.messages.middleware.MessageMiddleware',
        'django.middleware.clickjacking.XFrameOptionsMiddleware',
        'misc.middleware.NoAutoLocaleMiddleware',
        'django.middleware.locale.LocaleMiddleware',
    )
    # END MIDDLEWARE CONFIGURATION

    # MIGRATIONS CONFIGURATION
    MIGRATION_MODULES = {
        'sites': 'contrib.sites.migrations'
    }
    # END MIGRATIONS CONFIGURATION

    # DEBUG
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#debug
    DEBUG = values.BooleanValue(False)

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#template-debug
    TEMPLATE_DEBUG = DEBUG
    # END DEBUG

    # SECRET CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#secret-key
    # Note: This key only used for development and testing.
    #       In production, this is changed to a values.SecretValue() setting
    SECRET_KEY = 'CHANGEME!!!'
    # END SECRET CONFIGURATION

    # FIXTURE CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#std:setting-FIXTURE_DIRS
    FIXTURE_DIRS = (
        join(BASE_DIR, 'fixtures'),
    )
    # END FIXTURE CONFIGURATION

    # EMAIL CONFIGURATION
    EMAIL_BACKEND = values.Value('django.core.mail.backends.smtp.EmailBackend')
    # END EMAIL CONFIGURATION

    # MANAGER CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#admins
    ADMINS = (
        ("""Adam Dobrawy""", 'naczelnik@jawnosc.tk'),
    )

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#managers
    MANAGERS = ADMINS
    # END MANAGER CONFIGURATION

    # DATABASE CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#databases
    DATABASES = values.DatabaseURLValue('mysql://localhost/ankieta')
    # END DATABASE CONFIGURATION

    # CACHING
    # Do this here because thanks to django-pylibmc-sasl and pylibmc
    # memcacheify (used on heroku) is painful to install on windows.
    CACHES = {
        'default': {
            'BACKEND': 'django.core.cache.backends.filebased.FileBasedCache',
            'LOCATION': '/var/tmp/django_cache'
        }
    }
    # END CACHING

    # GENERAL CONFIGURATION

    # Local time zone for this installation. Choices can be found here:
    # http://en.wikipedia.org/wiki/List_of_tz_zones_by_name
    # although not all choices may be available on all operating systems.
    # In a Windows environment this must be set to your system time zone.
    TIME_ZONE = 'UTC'

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#language-code
    LANGUAGE_CODE = 'pl_PL'

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#site-id
    SITE_ID = 1

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#use-i18n
    USE_I18N = True

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#use-l10n
    USE_L10N = True

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#use-tz
    USE_TZ = True
    # END GENERAL CONFIGURATION

    # TEMPLATE CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#template-context-processors
    TEMPLATE_CONTEXT_PROCESSORS = (
        'django.contrib.auth.context_processors.auth',
        #'allauth.account.context_processors.account',
        #'allauth.socialaccount.context_processors.socialaccount',
        #'django.core.context_processors.debug',
        #'django.core.context_processors.i18n',
        #'django.core.context_processors.media',
        #'django.core.context_processors.static',
        #'django.core.context_processors.tz',
        #'django.contrib.messages.context_processors.messages',
        'django.core.context_processors.request' #,
       # 'constance.context_processors.config',
        # Your stuff: custom template context processors go here
    )

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#template-dirs
    TEMPLATE_DIRS = (
        join(BASE_DIR, 'templates'),
    )

    TEMPLATE_LOADERS = (
        'django.template.loaders.filesystem.Loader',
        'django.template.loaders.app_directories.Loader',
    )

    # See: http://django-crispy-forms.readthedocs.org/en/latest/install.html#template-packs
    CRISPY_TEMPLATE_PACK = 'bootstrap3'
    # END TEMPLATE CONFIGURATION

    # STATIC FILE CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#static-root
    STATIC_ROOT = join(os.path.dirname(BASE_DIR), 'staticfiles')

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#static-url
    STATIC_URL = '/static/'

    # See: https://docs.djangoproject.com/en/dev/ref/contrib/staticfiles/#std:setting-STATICFILES_DIRS
    STATICFILES_DIRS = (
        join(BASE_DIR, 'static'),
    )

    # See: https://docs.djangoproject.com/en/dev/ref/contrib/staticfiles/#staticfiles-finders
    STATICFILES_FINDERS = (
        'django.contrib.staticfiles.finders.FileSystemFinder',
        'django.contrib.staticfiles.finders.AppDirectoriesFinder',
    )
    # END STATIC FILE CONFIGURATION

    # MEDIA CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#media-root
    MEDIA_ROOT = join(BASE_DIR, 'media')

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#media-url
    MEDIA_URL = '/media/'
    # END MEDIA CONFIGURATION

    # URL Configuration
    ROOT_URLCONF = 'urls'

    # See: https://docs.djangoproject.com/en/dev/ref/settings/#wsgi-application
    WSGI_APPLICATION = 'wsgi.application'
    # End URL Configuration

    # AUTHENTICATION CONFIGURATION
    AUTHENTICATION_BACKENDS = (
        'django.contrib.auth.backends.ModelBackend',
        'allauth.account.auth_backends.AuthenticationBackend',
    )

    # Some really nice defaults
    # ACCOUNT_AUTHENTICATION_METHOD = 'username'
    # ACCOUNT_EMAIL_REQUIRED = True
    # ACCOUNT_EMAIL_VERIFICATION = 'mandatory'
    # END AUTHENTICATION CONFIGURATION

    # Custom user app defaults
    # Select the correct user model
    AUTH_USER_MODEL = 'users.User'
    # LOGIN_REDIRECT_URL = 'users:redirect'
    # LOGIN_URL = 'account_login'
    # END Custom user app defaults

    # SLUGLIFIER
    AUTOSLUG_SLUGIFY_FUNCTION = 'slugify.slugify'
    # END SLUGLIFIER

    # LOGGING CONFIGURATION
    # See: https://docs.djangoproject.com/en/dev/ref/settings/#logging
    # A sample logging configuration. The only tangible logging
    # performed by this configuration is to send an email to
    # the site admins on every HTTP 500 error when DEBUG=False.
    # See http://docs.djangoproject.com/en/dev/topics/logging for
    # more details on how to customize your logging configuration.
    LOGGING = {
        'version': 1,
        'disable_existing_loggers': False,
        'filters': {
            'require_debug_false': {
                '()': 'django.utils.log.RequireDebugFalse'
            }
        },
        'handlers': {
            'mail_admins': {
                'level': 'ERROR',
                'filters': ['require_debug_false'],
                'class': 'django.utils.log.AdminEmailHandler'
            }
        },
        'loggers': {
            'django.request': {
                'handlers': ['mail_admins'],
                'level': 'ERROR',
                'propagate': True,
            },
        }
    }
    # END LOGGING CONFIGURATION

    @classmethod
    def post_setup(cls):
        cls.DATABASES['default']['ATOMIC_REQUESTS'] = True

    # Your common stuff: Below this line define 3rd party library settings
    CONSTANCE_CONFIG = {
        'AGGREMENT_TEXT': ("Akceptuję Politykę Prywatności  i wyrażam zgodę na "
        "przetwarzanie moich danych osobowych w rozumieniu Ustawy o ochronie "
        "danych osobowych z 29 sierpnia 1997 r. przez Sieć Obywatelską Watchdog "
        "Polska z siedzibą w Warszawie, ul. Ursynowska 22/2 w celach związanych "
        "z przekazaniem petycji i informowaniem o niej zarówno mnie, jak i "
        "publicznie", 'Text of aggrement in submission form of "ankieta"'),
        "NEWSLETTER_TEXT": ("Wyrażam zgodę na przesyłanie informacji o działalności "
        "programowej Sieci Obywatelskiej Watchdog Polska", "Text of newsletter confirmation"),
        "SUCCESS_CONTACT": ("<p>Dziękujemy za wiadomość. Postaramy się udzielić "
            "odpowiedzi tak szybko jak to możliwe.</p>", "Text of success text in contact form"),
        "PAGE_NAME": ("Jawna kampania wyborcza", "ASCII name of page"),
        'ISSUE_SPOT': ("<p>Lorem ipsum</p>", "HTML code of video about petition"),
        'ISSUE_DESCRIPTION': ("<p>Lorem ipsum</p>", "HTML code of description of petition"),
        'LETTER_TEXT': ("<p><b>To:</b>Lorem</p><p>ipsum</p>", "HTML code of letter with recipient"),
        'LETTER_THANK_YOU': ("<p>Lorem ipsum</p>", "HTML code of thank you text"),
        'FOOTER_TEXT': ("<p>Lorem ipsum</p>", "HTML code of partners data"),
        'MEDIA_TEXT_1': ("<h2>Lorem</h2><p>ipsum</p>", "HTML code of first media text"),
        'MEDIA_TEXT_2': ("<h2>Lorem</h2><p>ipsum</p>", "HTML code of second media text"),
        'MEDIA_TEXT_3': ("<h2>Lorem</h2><p>ipsum</p>", "HTML code of third media text"),
        'GITHUB_URL': ("http://github.com/watchdogpolska/ambasadorzy.siecobywatelska.pl", "URL of Github repo with app"),
        'META_DESCRIPTION': ("Lorem ipsum", "ASCII Meta and Facebook description"),
    }
    CONSTANCE_BACKEND = 'constance.backends.database.DatabaseBackend'
    CONSTANCE_DATABASE_CACHE_BACKEND = 'default'
