// received help from writeup: https://hiroki6.dev/posts/simple-encryptor/
// Needed help with Reversing the encrypted functions operations
// Flag open section: OK
// bad seed understanding: OK
//

#include <stdio.h>
#include <stdlib.h>

int main(void) {
    typedef unsigned char byte;
    FILE *fp;
    size_t flagSize;
    byte *flag;
    unsigned int seed;
    long i;
    int random1, random2, obtain_time;



/*   
  flag_fp = fopen("flag","rb");
  fseek(flag_fp,0,2);
  fp_currentPosition = ftell(flag_fp);
  fseek(flag_fp,0,0);
  flag_fp_malloc = malloc(fp_currentPosition);
  fread(flag_fp_malloc,fp_currentPosition,1,flag_fp);
  fclose(flag_fp);
*/
    fp = fopen("flag.enc", "rb");
    // seek until the end of the file to get the size
    fseek(fp, 0, SEEK_END);
    flagSize = ftell(fp);

    // seek to the beginning
    fseek(fp, 0, SEEK_SET);

    // allocate memory of the flag
    // Using malloc because the actual size is unknown.
    flag = malloc(flagSize);
    fread(flag, 1, flagSize, fp);
    fclose(fp);


/*
  obtain_time = time((time_t *)0x0);
  seed = (uint)obtain_time;
  srand(seed);
*/
    // Encryptor only take 4 bytes
    // fwrite(&seed,1,4,flagenc_fp);
    memcpy(&seed, flag, 4);
    srand(seed);

/*
  for (loopInt = 0; loopInt < (long)fp_currentPosition; loopInt = loopInt + 1) {
    random = rand();
    *(byte *)((long)flag_fp_malloc + loopInt) =
         *(byte *)((long)flag_fp_malloc + loopInt) ^ (byte)random;
    random2 = rand();
    random2 = random2 & 7;
    *(byte *)((long)flag_fp_malloc + loopInt) =
         *(byte *)((long)flag_fp_malloc + loopInt) << (sbyte)random2 |
         *(byte *)((long)flag_fp_malloc + loopInt) >> 8 - (sbyte)random2;
  }
*/

    // Reverse encryption & print
    for(i = 4; i < (long)flagSize; i++) {


	// Nothing to reverse
	// Include a 7 in random2
	// Mimic the order
        random1 = rand();
        random2 = rand();
        random2 = random2 & 7;

	// reverse operations
        flag[i]  = 
            flag[i] >> random2 |
            flag[i] << 8 - random2;
	
	// random2
	// Reverse XOR operation
	flag[i] = random1 ^ flag[i];

        printf("%c", flag[i]);
    }
}
