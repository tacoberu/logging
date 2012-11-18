logging
=======

Logging for php.

Class Log je vlastní logger, obsahuje obvyklé metody debug(), fatal(), error() atd.

Lze mu nastavit úložiště, do kterého se budou logy posílat.
Zároveň je možno nastavit filtr, za jaký typ obsahu se zaloguje, a jaký se vypustí.
Filtruje se podle závažnosti logu, a podle značky logu.
