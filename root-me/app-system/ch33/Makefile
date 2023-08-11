CHALLENGE=ch33
USER=app-systeme-$(CHALLENGE)
USER_CRACKED=$(USER)-cracked

CC=gcc
CFLAGS=-m32 -no-pie -fno-stack-protector -mpreferred-stack-boundary=2
LDFLAGS=-z noexecstack -Wl,--rpath=/libold/i386-linux-gnu/ -Wl,--dynamic-linker=/libold/i386-linux-gnu/ld-2.19.so

SRC=$(CHALLENGE).c
OBJ=$(SRC:.c=.o)
BIN=$(CHALLENGE)

.DEFAULT_GOAL := challenge
.PHONY : clean all

$(BIN): $(OBJ)
	@echo "Compiling..."
	$(CC) -o $@ $(SRC) $(LDFLAGS) $(CFLAGS)

challenge: $(BIN)
	@echo "Applying permissions..."
	rm -f $(OBJ)
	chown $(USER_CRACKED):$(USER) $(BIN) .passwd Makefile $(SRC)
	chmod 400 .passwd
	chmod 440 $(SRC) Makefile
	chmod 550 $(BIN)
	chmod u+s $(BIN)

