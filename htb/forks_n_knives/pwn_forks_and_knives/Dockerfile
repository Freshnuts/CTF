FROM ubuntu:22.04

RUN groupadd -r ctf && useradd -r -g ctf ctf

ADD --chown=ctf challenge/ /home/ctf/
# RUN chmod 440 /home/ctf/flag.txt
# RUN mv /home/ctf/flag.txt /home/ctf/flag$(cat /dev/urandom | tr -cd 'a-f0-9' | head -c 16).txt
RUN chmod 774 /home/ctf/server

USER ctf
EXPOSE 1337
WORKDIR /home/ctf
ENTRYPOINT ["./server"]
