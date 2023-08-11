CHALLENGE=ch20
USER=app-systeme-$(CHALLENGE)
USER_CRACKED=$(USER)-cracked

CC=afl-g++
CFLAGS=-m32 -Wall -no-pie
LDFLAGS=-z execstack

SRC=$(CHALLENGE).cpp
OBJ=$(SRC:.cpp=.o)
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

