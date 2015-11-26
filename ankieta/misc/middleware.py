class NoAutoLocaleMiddleware(object):

    def process_request(self, request):
        request.META['HTTP_ACCEPT_LANGUAGE'] = ''
