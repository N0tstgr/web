#include <stdio.h>
 int main(){
 //dowhilenested loop
 int i = 1;
do{
    int j = 1;
    printf("table of %d\n", i);

    do{
        printf("%d * %d = %d\n", i, j, i*j);
        j++;

    }while (j<=10);

    printf("\n");
    i++;
}while (i<=5);
    return 0;

    
}