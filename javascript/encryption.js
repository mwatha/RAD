
 var encryptionKey = {}

 encryptionKey["A"] = "Z"
 encryptionKey["B"] = "Y"
 encryptionKey["C"] = "X"
 encryptionKey["D"] = "W"
 encryptionKey["E"] = "V"
 encryptionKey["F"] = "U"
 encryptionKey["G"] = "T"
 encryptionKey["H"] = "S"
 encryptionKey["I"] = "R"
 encryptionKey["J"] = "Q"
 encryptionKey["K"] = "P"
 encryptionKey["L"] = "0"
 encryptionKey["M"] = "N"
 encryptionKey["N"] = "M"
 encryptionKey["O"] = "L"
 encryptionKey["P"] = "K"
 encryptionKey["Q"] = "J"
 encryptionKey["R"] = "I"
 encryptionKey["S"] = "H"
 encryptionKey["T"] = "G"
 encryptionKey["U"] = "F"
 encryptionKey["V"] = "E"
 encryptionKey["W"] = "D"
 encryptionKey["X"] = "C"
 encryptionKey["Y"] = "B"
 encryptionKey["Z"] = "A"

 encryptionKey["a"] = "z"
 encryptionKey["b"] = "y"
 encryptionKey["c"] = "x"
 encryptionKey["d"] = "w"
 encryptionKey["e"] = "v"
 encryptionKey["f"] = "u"
 encryptionKey["g"] = "t"
 encryptionKey["h"] = "s"
 encryptionKey["i"] = "r"
 encryptionKey["j"] = "q"
 encryptionKey["k"] = "p"
 encryptionKey["l"] = "o"
 encryptionKey["m"] = "n"
 encryptionKey["n"] = "m"
 encryptionKey["o"] = "l"
 encryptionKey["p"] = "k"
 encryptionKey["q"] = "j"
 encryptionKey["r"] = "i"
 encryptionKey["s"] = "h"
 encryptionKey["t"] = "g"
 encryptionKey["u"] = "f"
 encryptionKey["v"] = "e"
 encryptionKey["w"] = "d"
 encryptionKey["x"] = "c"
 encryptionKey["y"] = "b"
 encryptionKey["z"] = "a"

 encryptionKey["1"] = "0"
 encryptionKey["2"] = "9"
 encryptionKey["3"] = "8"
 encryptionKey["4"] = "7"
 encryptionKey["5"] = "6"
 encryptionKey["6"] = "5"
 encryptionKey["7"] = "4"
 encryptionKey["8"] = "3"
 encryptionKey["9"] = "2"
 encryptionKey["0"] = "1"


function encrypt(string) {
 var return_string = ""
 var stringArray = string.split("");
 for(var i = 0 ; i < stringArray.length; i++) {
   str = ''
   str = encryptionKey[stringArray[i]];

   if (str) {
     return_string+=str 
   }else{
     return_string+=stringArray[i];
   }
 }
 return return_string;
}

