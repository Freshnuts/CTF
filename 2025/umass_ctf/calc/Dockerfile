FROM docker.io/debian:bookworm

WORKDIR /home/ctf

RUN useradd -d /home/ctf -u 1001 ctf

COPY --chown=root:root assets ./

ENTRYPOINT [ "./ynetd", "-p", "4444", "-u", "ctf", "/home/ctf/calc" ]