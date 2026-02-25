type Puissance = Int
type Coeff= Integer
type Valeur = Integer
type Polynome= [Coeff]

evaluerPoly :: Polynome -> Valeur -> Valeur
evaluerPoly poly x =
    sum [ a * x^p | (a,p) <- zip poly [0..] ]


plusPoly :: Polynome -> Polynome -> Polynome
plusPoly [] b=b
plusPoly a []=a

plusPoly (a:xs) (b:ys) = (a+b):plusPoly xs ys


multParCst :: Coeff -> Polynome -> Polynome
multParCst a b= map (a*) b


multPoly :: Polynome -> Polynome -> Polynome
multPoly [] _ = []
multPoly _ [] = []
multPoly poly1 poly2 =
    foldl plusPoly [] [ replicate i 0 ++ (multParCst b poly1) | (b,i) <- zip poly2 [0..] ]



deriveePoly :: Polynome -> Polynome
deriveePoly []=[]
deriveePoly (_:as)= [p*x| (x,p)<-zip as [1..]]


--ex 2

type Facteur=Int
type Exposant=Int
type Couple= (Facteur,Exposant)
type Decomposition= [Couple]


rep2int,rep2intBis::Decomposition->Int
rep2int []=1
rep2int xs = foldr (*) 1 [x^y |(x,y)<-xs ]

rep2intBis[]= 1
rep2intBis ((x,n):xs)= x^n * rep2intBis xs





estPremier:: Decomposition ->Bool
estPremier []=False
estPremier xs= any first [x^y |(x,y)<-xs ]
  where first:: Int-> Bool
        first x
          | x>1 && length [n|n<-[2..x], mod x n == 0] ==1 = True 
          |otherwise=False

pgcd,pgcdBis:: Decomposition-> Decomposition -> Decomposition
pgcd xs ys = [(a, min b d) | (a,b)<-xs, (c,d)<-ys, a == c   ]

pgcdBis [] _ = []
pgcdBis _ [] = []

pgcdBis ((k1,d1):p1) ((k2,d2):p2)
  | k1 == k2 = (k1, min d1 d2) : pgcdBis p1 p2
  | k1 <  k2 = pgcdBis p1 ((k2,d2):p2)
  | otherwise = pgcdBis ((k1,d1):p1) p2