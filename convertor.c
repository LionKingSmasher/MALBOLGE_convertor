#include <stdio.h>
#include <fcntl.h>

const char ROT[] = "\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+)("; //*
const char CRZ[] = ">=<;:9876543210/.-,+)(\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?"; //p
const char MOVD[] = "(\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+)"; //j
const char NOP[] = "DCBA@?>=<;:9876543210/.-,+)(\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFE"; //o
const char INPUT[] = "utsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+)(\'$%$#\"!~}|{zyxwv"; // /
const char STOP[] = "QPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+)(\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSR"; //v
const char PRINT[] = "cba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+)(\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfed"; //<
const char JMP[] = "ba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+)(\'$%$#\"!~}|{zyxwvutsrqponmlkjihgfedc"; //i

int main(int argc, char** argv){
    FILE *fd, *m2m;
    int read_byte;
    int i = 0;
    fd=fopen(argv[1], "r");
    m2m=fopen(argv[2], "w");
    while(1) {
        read_byte = fgetc(fd);
        if(!feof(fd)){
            switch (read_byte)
            {
            case '*':
                fputc(ROT[i++%94], m2m);
                break;
            case 'p':
                fputc(CRZ[i++%94], m2m);
                break;
            case 'j':
                fputc(MOVD[i++%94], m2m);
                break;
            case 'o':
                fputc(NOP[i++%94], m2m);
                break;
            case '/':
                fputc(INPUT[i++%94], m2m);
                break;
            case 'v':
                fputc(STOP[i++%94], m2m);
                break;
            case '<':
                fputc(PRINT[i++%94], m2m);
                break;
            case 'i':
                fputc(JMP[i++%94], m2m);
                break;
            default:
                break;
            }
        }
        else break;
    }
    fclose(fd);
    fclose(m2m);
}