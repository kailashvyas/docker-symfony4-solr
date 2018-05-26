FROM solr:6.0

USER root

RUN mkdir -p /opt/solr/solr_data

RUN chown -R $SOLR_USER:$SOLR_USER /opt/solr/solr_data

ADD ./solr.json /opt/solr/solr_data/

RUN /opt/solr/bin/solr start && \
    /opt/solr/bin/solr create -c tmdb &&\
    /opt/solr/bin/post -c tmdb /opt/solr/solr_data/solr.json