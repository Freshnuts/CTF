#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <unistd.h>

struct Zombie {
    int hp;
    void (*hurt)();
    void (*eatBody)();
    void (*attack)();
    int living;
};

struct Human {
    int hp;
    void (*fire)(int);
    void (*prayChuckToGiveAMiracle)();
    void (*suicide)();
    int living;
};

struct Zombie *zombies[3];
struct Human *human = NULL;

void fire(int zombieIndex) {
    struct Zombie *zombie = zombies[zombieIndex];
    int hits = rand() % 10;
    printf("%d hits in his face\n", hits);
    zombie->hp -= hits;

    if (zombie->hp <= 0) {
        memset(zombie, 0, sizeof(struct Zombie));
        free(zombie); // Locate where we can do 2 free consecutively
        zombies[zombieIndex] = NULL;
        puts("The zombie die");
    }
    else {
        printf("The zombie has %d HP\n", zombie->hp);
    }
}

void prayChuckToGiveAMiracle() {
    char flag[32] = { 0 };
    FILE *flagFile = fopen(".passwd", "r");
    if (flagFile) {
        fread(flag, 1, 32, flagFile);
        flag[20] = 0;
        sleep(5);
        puts("Chuck Norris arrives, kills every zombie like a boss. Turns back to you and says:");
        puts(flag);
    }
    exit(0);
}

void suicide() {
    puts("You can't survive at this zombie wave. *PAM*");
    memset(human, 0, sizeof(struct Human));
    free(human); // Locate where we can do 2 free consecutively
}

struct Human *newHuman() {
    puts("A new human arrives in the battle");
    struct Human *human = malloc(sizeof(struct Human)); // 1st
    human->hp = 10 + rand() % 50;
    human->fire = fire;
    human->prayChuckToGiveAMiracle = prayChuckToGiveAMiracle;
    human->suicide = suicide;
    human->living = 1;
    return human;
}

void sound() {
    puts("Rhooarg...");
}

void eatBody(int zombieIndex) {
    struct Zombie *zombie = zombies[zombieIndex];
    puts("The zombie eats an unfortunate mate, RIP bro");
    sleep(2);
    puts("But this bro hold a grenade in his hand... Good bye zombie");

    memset(zombie, 0, sizeof(struct Zombie));
    free(zombie);   // Locate where we can do 2 free consecutively
    zombies[zombieIndex] = NULL;
}

void attack() {
    int hits = rand() % 10;
    printf("The zombie hits you %d times\n", hits);
    human->hp -= hits;
    if (human->hp <= 0) {
        memset(human, 0, sizeof(struct Human));
        free(human);  // Locate where we can do 2 free consecutively
        human = NULL;
        puts("You die");
    }
    else {
        printf("You have %d HP\n", human->hp);
    }
}

struct Zombie *newZombie() {
    puts("A new zombie arrives");
    struct Zombie *zombie = malloc(sizeof(struct Zombie)); // 2nd
    zombie->hp = 10 + rand() % 40;
    zombie->eatBody = eatBody;
    zombie->living = 1;
    zombie->attack = attack;

    return zombie;
}

char getChar() {
    char nl;
    char ret = getc(stdin);
    nl = getc(stdin);
    if (nl != '\n')
    {
        puts("Only one char is requested");
        exit(0);
    }
    return ret;
}

int eraseNl(char *line) {
    for (; *line != '\n'; line++);
    *line = 0;
    return 0;
}

int main() {
    int end = 0;
    char order = -1;
    char nl = -1;
    char line[64] = {0};
    
    memset(zombies, 0, 3 * sizeof(struct Zombie *));
    
    while (!end) {
        puts("1: Take a new character\n2: Fire on a zombie\n3: Suicide you\n4: Pray Chuck Norris to help you\n5: Raise a new zombie\n6: A zombie attacks\n7: A zombie eats a body\n0: Quit");
        order = getChar();
        switch (order) {
        case '1':
            if (human) {
                puts("You have already a character");
            }
            else {
                human = newHuman();
            }
            break;
        case '2':
            if (human) {
                puts("Which zombie do you shoot? (1-3)");
                order = getChar() - 0x30;
                if (order < 1 || order > 3)
                    puts("You miss all the target");
                else if (zombies[order - 1])
                    human->fire(order - 1);
                else
                    puts("There isn't a zombie here");
            }
            else {
                puts("You're already dead");
            }
            break;
        case '3':
            if (human) {
                human->suicide();
            }
            else {
                puts("You're already dead");
            }
            break;
        case '4':
            if (human) {
                puts("You pray, you pray, you pray...\nAnd you see the zombie in front of you... \nYou die, you die, you die");
                memset(human, 0, sizeof(struct Human));
                free(human); // Locate where we can do 2 free consecutively
                human = NULL;
            }
            else {
                puts("You're already dead");
            }
            break;
        case '5':
            puts("Which zombie arrives? (1-3)");
            order = getChar() - 0x30;
            if (order < 1 || order > 3) {
                puts("There are only 3 zombies slots on this road");
            }
            else if (zombies[order - 1] && zombies[order - 1]->living) {
                printf("Zombie %d is already here\n", order);
            }
            else {
                zombies[order - 1] = newZombie();
            }
            break;
        case '6':
            puts("Which zombie attacks? (1-3)");
            order = getChar() - 0x30;
            if (order < 1 || order > 3) {
                puts("There are only 3 zombie slots on this road");
            }
            else if (zombies[order - 1] && zombies[order - 1]->living) {
                if (human) {
                    zombies[order - 1]->attack();
                }
                else {
                    puts("You're already dead");
                }
            }
            else {
                puts("This zombie is already dead");
            }
            break;
        case '7':
            puts("Which zombie eats? (1-3)");
            order = getChar() - 0x30;
            if (order < 1 || order > 3) {
                puts("There are only 3 zombies slots on this road");
            }
            else if (zombies[order - 1]) {
                zombies[order - 1]->eatBody(order - 1);
            }
            else {
                puts("This zombie is already dead");
            }
            break;
        case '0':
        default:
            end = 1;
        }
    }
    return 0;
}
