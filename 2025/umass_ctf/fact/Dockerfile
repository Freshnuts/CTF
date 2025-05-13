FROM ubuntu:24.04
WORKDIR /home/ctf

ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install gcc -y
RUN useradd -d /home/ctf -u 1001 ctf
COPY --chown=root:root assets ./
# RUN gcc main.c -o fact

ENTRYPOINT [ "./ynetd", "-p", "4444", "-u", "ctf", "/home/ctf/fact" ]