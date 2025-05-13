FROM ubuntu:24.04@sha256:72297848456d5d37d1262630108ab308d3e9ec7ed1c3286a32fe09856619a782

ENV user=copy
ENV port=1337

# Install packages
RUN apt-get update \
 && DEBIAN_FRONTEND=noninteractive \
    apt-get install --no-install-recommends -y socat libc6=2.39-0ubuntu8.4 \
 && rm -rf /var/lib/apt/lists/*

# Change tmp permissions
RUN chmod 1733 /tmp /var/tmp /dev/shm

# Add user
RUN useradd -M $user

# Add files
COPY --chown=root:$user copy flag /

# chown & chmod files
RUN chmod 755 /copy \
 && chmod 440 /flag

# Run server
WORKDIR /
CMD socat -t 30 -T 30 TCP-LISTEN:$port,reuseaddr,fork EXEC:"/copy",su=$user
EXPOSE $port
