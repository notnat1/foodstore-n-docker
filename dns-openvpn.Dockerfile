FROM ubuntu:22.04

WORKDIR /root

RUN apt-get update && \
    apt-get install -y \
    software-properties-common \
    curl \
    net-tools \
    bind9 \
    bind9utils \
    bind9-doc \
    bash-completion \
    nano \
    elinks

RUN curl -O https://raw.githubusercontent.com/angristan/openvpn-install/master/openvpn-install.sh && chmod +x openvpn-install.sh

RUN sed -i 's/\/bin\/bash/\/usr\/bin\/bash/g' /etc/passwd

EXPOSE 53
EXPOSE 1194

CMD ["bash"]
