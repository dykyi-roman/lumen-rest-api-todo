To work with the documentation you need to install sphinx-doc:

> sudo apt-get install sphinx-common

> sudo apt-get install python-pip

> sudo pip install sphinx_rtd_theme

> make html # to generate docs. see result as _build/html


For MacOSx:

> sudo pip install -U sphinx --ignore-installed six
> sudo pip install sphinx_rtd_theme

May need to install this too:

 For Python 3:

  $ apt-get install python3-sphinx

 For Python 2:

  $ apt-get install python-sphinx


In order to collect the dock:

> make html


Build and run a container for assembling docks:

> docker build . -t ncdoc

> docker run -v "$(pwd)":/var/docs -ti ncdoc:latest