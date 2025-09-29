FROM nginx:alpine

COPY nginx-proxy.conf /etc/nginx/conf.d/default.conf
# COPY html/ /usr/share/nginx/html
COPY ./ssl/foodstore.crt /etc/ssl/foodstore.crt
COPY ./ssl/foodstore.key /etc/ssl/foodstore.key

EXPOSE 80
EXPOSE 443
