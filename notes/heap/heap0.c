#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <stdio.h>
#include <sys/types.h>

struct data {					// 1st object on heap; name[64]
 char name[64];
};

struct fp {						// 2nd Object on heap: fp
 int (*fp)();					// (contains pointer)
};

void winner()					// We want to execute winner()
{
 printf("level passed\n");
}

void nowinner()
{
 printf("level has not been passed\n");
}

int main(int argc, char **argv)
{
 struct data *d;
 struct fp *f;

 d = malloc(sizeof(struct data));	// malloc allocates storage on the heap
 f = malloc(sizeof(struct fp));
 f->fp = nowinner;					// fp points to nowinner()

 printf("data is at %p, fp is at %p\n", d, f);

 strcpy(d->name, argv[1]);	// argv[1] copied into 64-byte array on heap,
							// without checking its length
 f->fp();

}

