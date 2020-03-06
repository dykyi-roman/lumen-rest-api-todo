FROM ubuntu:18.04

ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update
RUN apt-get install -y sphinx-common \
       python-pip

RUN pip install sphinx_rtd_theme && \
    pip install sphinx_bootstrap_theme && \
    pip install guzzle_sphinx_theme

WORKDIR /var/neocore/docs

CMD make html
