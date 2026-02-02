appartenance:: Eq a=>a ->[a]->Bool
appartenance _ []= False
appartenance a (b:bx)
  | a==b = True
  |otherwise = appartenance a bx

suprDbl:: Eq a=>[a]->[a]
suprDbl []=[]
suprDbl (a:ax)
  |appartenance a ax = suprDbl ax
  |otherwise = a : suprDbl ax

question3::Ord a=>a->[a]->[a]
question3 _ [] = []
question3 a b
  | head b < a = question3 a (tail b)
  |otherwise = (head b) : question3 a (tail b)


inclusion:: Eq a => [a]->[a]->Bool
inclusion [] _=True
inclusion (a:ax) b
  | appartenance a b ==False = False
  |otherwise = inclusion ax b


intersec:: Eq a => [a]->[a]->[a]
intersec [] _=[]
intersec  _ []=[]
intersec (a:ax) b
  | appartenance a b = a:intersec ax (filter (/= a) b)
  |otherwise = intersec ax b

union_aux:: Eq a=> [a] ->[a]->[a]
union_aux [] b = b
union_aux (a:ax) b 
  |appartenance a b = a: union_aux ax (filter (/= a) b)
  |otherwise = a: union_aux ax b

union::Eq a => [a]->[a]->[a]
union a b= suprDbl (union_aux a b)

sommeIntersection:: (Num a,Eq a) => [a]->[a]-> a
sommeIntersection a b= sum(intersec a b)