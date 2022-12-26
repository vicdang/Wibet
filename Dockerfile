FROM php:7.4-fpm

COPY . /home/wibet

WORKDIR /home/wibet

#RUN php yii serve 0.0.0.0 --port=4000&

EXPOSE 4000

CMD php yii serve 0.0.0.0 --port=4000

#CMD ["php yii serve 0.0.0.0 --port=400"]
