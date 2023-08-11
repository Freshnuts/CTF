#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <stdio.h>

class formatter
{
public :
    virtual int  RTTI(  )  =0 ;
    virtual void  displayName(  )  =0 ;
    virtual void format( const char * ptr )  =0 ;

};

class UpperFormatter: public formatter
{
public :


    virtual int  RTTI(  )  { return 1; };

    virtual void  displayName(  )  { printf ("UpperFormatter"); }

    virtual void format( const char * ptr )
    {
        const char * cptr = ptr;
        while (*cptr)
        {
            printf("%c", toupper(*cptr));
            cptr++;
        }
    }
};


class LowerFormatter: public formatter
{
public :
    virtual int  RTTI(  )  { return 2; };

    virtual void  displayName(  )  { printf ("UpperFormatter"); }

    virtual void format( const char * ptr )
    {
        const char * cptr = ptr;
        while (*cptr)
        {
            printf("%c", tolower(*cptr));
            cptr++;
        }
    }
};
#define SIZE (80)
class MyStringFormatter
{
public:
    MyStringFormatter( formatter * pFormatter  ):m_pFormatter(pFormatter),m_Id(1) {};
    void GetInput(int padding )  {
        memset(str ,' ' , SIZE  ); fgets(str+padding,SIZE,stdin); }
    void display() const{m_pFormatter->format(str) ;}
protected:
    char str[SIZE];
    formatter * m_pFormatter ;
    int m_Id;
};




int main(int argc, char* argv[])
{
    printf("Padding : 1-5\r\n");
    char size[4];
    int padding  = atoi(fgets(size,4,stdin));
    if (padding <0 || padding >5)
    {
        printf ("Padding error\r\n");
        exit(0);
    }
    printf("\r\n\r\n\tConvert in : \r\n");
    printf("\t  1: uppercase  \r\n");
    printf("\t  2: lowercase  \r\n");
    int choice  = atoi(fgets(size,4,stdin));

    formatter * pformatter = NULL;
    switch (choice)
    {
    case 1:
        pformatter =  new UpperFormatter ;

        break;
    case 2:
        pformatter =  new LowerFormatter ;
        break;
    }
    if (pformatter == NULL)
    {
        printf ("Bad choice!\r\n");
        exit(0);
    }
    MyStringFormatter formatter(pformatter  );
    printf("String to convert: \r\n");
    formatter.GetInput(padding);
    formatter.display();

    return 0;

}

