data Temp = Celsius Float | Fahrenheit Float | Kelvin Float deriving (Show,Eq)

toCelsius, toFahrenheit, toKelvin :: Temp -> Temp
toCelsius a =
  case a of
    Celsius x     -> Celsius x
    Fahrenheit x  -> Celsius ((x - 32) * 5 / 9)
    Kelvin x      -> Celsius (x - 273)

toFahrenheit a =
  case a of
    Celsius x     -> Fahrenheit (32+9/5 * x)
    Fahrenheit x  -> Fahrenheit x
    Kelvin x      ->  Fahrenheit (32 + 9/5 * (x - 273))

toKelvin a =
  case a of
    Celsius x     -> Kelvin (x+273)
    Fahrenheit x  -> Kelvin (273+ (x - 32) * 5 / 9 )
    Kelvin x      -> Kelvin x


eqTemp, infTemp :: Temp -> Temp -> Bool
eqTemp a b =
  let (Celsius x) = toCelsius a
      (Celsius y) = toCelsius b
  in x == y

infTemp a b =
  let (Celsius x) = toCelsius a
      (Celsius y) = toCelsius b
  in x < y


data Voyageur = Voyageur { nom :: String, prenom :: String, age :: Int } deriving (Show)

voyageurs = [ Voyageur "Metivier" "Alice" 30
            , Voyageur "Dubois" "Patrice" 62
            , Voyageur "Roche" "Charlie" 30
            , Voyageur "Petit" "Rose" 23
            , Voyageur "Fontaine" "Eve" 28
            , Voyageur "Guillaume" "Julien" 2
            ]
groupVoyageurs :: [Voyageur] -> ([Voyageur], [Voyageur], [Voyageur], [Voyageur])
groupVoyageurs voyageur= ([v|v<-voyageur, age v >=0 && age v <=3] , [v|v<-voyageur, age v >=4 && age v <=29] , [v|v<-voyageur, age v >=30 && age v <=59 ], [v|v<-voyageur, age v >=60])


data Formule = Vrai | Faux |Non Formule | Et Formule Formule |Ou Formule Formule deriving (Show)

eval :: Formule -> Formule
eval Vrai = Vrai
eval Faux = Faux
eval (Non a) =
  case eval a of
    Vrai -> Faux
    Faux -> Vrai
    x -> Non x


eval (Et a b) =
  case (eval a, eval b) of
    (Vrai, x) -> x
    (x, Vrai) -> x
    (Faux, _) -> Faux
    (_, Faux) -> Faux
    (x, y) -> Et x y


eval (Ou a b) =
  case (eval a, eval b) of
    (Faux, x) -> x
    (x, Faux) -> x
    (Vrai, _) -> Vrai
    (_, Vrai) -> Vrai
    (x, y) -> Ou x y



evaluerRec :: Formule -> Formule
evaluerRec Vrai = Vrai
evaluerRec Faux = Faux
evaluerRec (Non a) =
  case evaluerRec a of
    Vrai -> Faux
    Faux -> Vrai
    x -> Non x


evaluerRec (Et a b) =
  case evaluerRec a of
    Faux -> Faux  -- Court-circuit : arrête si Faux
    Vrai -> evaluerRec b  -- Continue seulement si Vrai
    x -> case evaluerRec b of
           Faux -> Faux  -- Arrête si Faux
           y -> Et x y


evaluerRec (Ou a b) =
  case evaluerRec a of
    Vrai -> Vrai  -- Court-circuit : arrête si Vrai
    Faux -> evaluerRec b  -- Continue seulement si Faux
    x -> case evaluerRec b of
           Vrai -> Vrai  -- Arrête si Vrai
           y -> Ou x y


