# TD 13 - Permutations et tris (raisonnement pas a pas)

Convention du document : quand on ecrit un produit de permutations, on applique d'abord celle de droite, puis on va vers la gauche.

---

## Exercice 1

On considere

$$
\alpha=\begin{pmatrix}
1&2&3&4&5\\
3&4&5&1&2
\end{pmatrix}.
$$

### 1) Calculer la permutation reciproque $\alpha^{-1}$

**Raisonnement a avoir**

Pour trouver $\alpha^{-1}$, il faut "remonter" les fleches :
- si $\alpha(x)=y$, alors $\alpha^{-1}(y)=x$.
- en pratique, pour chaque valeur d'arrivee $y$, on cherche qui envoie vers $y$.

**Calcul detaille**

- $\alpha(4)=1$, donc $\alpha^{-1}(1)=4$.
- $\alpha(5)=2$, donc $\alpha^{-1}(2)=5$.
- $\alpha(1)=3$, donc $\alpha^{-1}(3)=1$.
- $\alpha(2)=4$, donc $\alpha^{-1}(4)=2$.
- $\alpha(3)=5$, donc $\alpha^{-1}(5)=3$.

Donc

$$
\alpha^{-1}=\begin{pmatrix}
1&2&3&4&5\\
4&5&1&2&3
\end{pmatrix}.
$$

**Verification rapide**

Par exemple, $\alpha^{-1}(1)=4$ puis $\alpha(4)=1$, donc c'est coherent.

### 2) Decomposer $\alpha$ en cycles disjoints

**Raisonnement a avoir**

Pour construire les cycles disjoints :
1. prendre un element non traite,
2. appliquer la permutation plusieurs fois,
3. s'arreter quand on revient au depart,
4. recommencer avec un element jamais rencontre.

**Calcul detaille**

On part de 1 :

$$
1\to3\to5\to2\to4\to1.
$$

On revient a 1, donc on a le cycle

$$
(1\ 3\ 5\ 2\ 4).
$$

Tous les elements 1,2,3,4,5 sont deja dedans. Il n'y a pas d'autre cycle.

Conclusion :

$$
\alpha=(1\ 3\ 5\ 2\ 4).
$$

### 3) En deduire une expression de $\alpha^{-1}$ en cycles disjoints

**Raisonnement a avoir**

L'inverse d'un cycle se lit a l'envers :

$$
(a_1\ a_2\ \dots\ a_k)^{-1}=(a_1\ a_k\ \dots\ a_2).
$$

Ici :

$$
\alpha=(1\ 3\ 5\ 2\ 4)
\quad\Rightarrow\quad
\alpha^{-1}=(1\ 4\ 2\ 5\ 3).
$$

**Pourquoi ?**

Dans $\alpha$, on a $1\mapsto3$. Donc dans $\alpha^{-1}$, on doit avoir $3\mapsto1$ : c'est exactement ce que fait $(1\ 4\ 2\ 5\ 3)$.

---

## Exercice 2

Objectif : decomposer chaque permutation en cycles disjoints.

Methode identique a l'exercice 1 : on suit les trajectoires jusqu'au retour au point de depart.

### 1)

$$
\sigma=\begin{pmatrix}
1&2&3&4&5&6&7&8&9\\
9&8&7&6&5&4&3&2&1
\end{pmatrix}.
$$

**Raisonnement**

- $1\to9\to1$, donc $(1\ 9)$.
- $2\to8\to2$, donc $(2\ 8)$.
- $3\to7\to3$, donc $(3\ 7)$.
- $4\to6\to4$, donc $(4\ 6)$.
- $5\to5$ : point fixe (on peut l'omettre).

Conclusion :

$$
\sigma=(1\ 9)(2\ 8)(3\ 7)(4\ 6).
$$

### 2)

$$
\tau=\begin{pmatrix}
1&2&3&4&5&6&7\\
7&6&1&2&3&4&5
\end{pmatrix}.
$$

**Raisonnement**

- Partir de 1 : $1\to7\to5\to3\to1$, donc $(1\ 7\ 5\ 3)$.
- Prendre ensuite un element non traite, 2 : $2\to6\to4\to2$, donc $(2\ 6\ 4)$.

Conclusion :

$$
\tau=(1\ 7\ 5\ 3)(2\ 6\ 4).
$$

### 3)

$$
\rho=\begin{pmatrix}
1&2&3&4&5&6&7&8\\
6&2&5&7&8&1&3&4
\end{pmatrix}.
$$

**Raisonnement**

- Partir de 1 : $1\to6\to1$, donc $(1\ 6)$.
- Prendre 3 : $3\to5\to8\to4\to7\to3$, donc $(3\ 5\ 8\ 4\ 7)$.
- 2 est fixe : $2\to2$.

Conclusion :

$$
\rho=(1\ 6)(3\ 5\ 8\ 4\ 7).
$$

---

## Exercice 3

### 1) Executer le tri bulle sur $(4,5,1,2,3)$

**Raisonnement a avoir**

Le tri bulle compare des voisins. Si l'ordre est mauvais, on echange.
Chaque echange de positions $j$ et $j+1$ est la transposition adjacente $(j\ j+1)$.

**Execution detaillee**

Depart :

$$
(4,5,1,2,3)
$$

Passe $i=1$ :
- $j=1$ : $4<5$ (rien)
- $j=2$ : $5>1$ :
  $(4,5,1,2,3)\xrightarrow{(2\ 3)}(4,1,5,2,3)$
- $j=3$ : $5>2$ :
  $(4,1,5,2,3)\xrightarrow{(3\ 4)}(4,1,2,5,3)$
- $j=4$ : $5>3$ :
  $(4,1,2,5,3)\xrightarrow{(4\ 5)}(4,1,2,3,5)$

Passe $i=2$ :
- $j=1$ : $4>1$ :
  $(4,1,2,3,5)\xrightarrow{(1\ 2)}(1,4,2,3,5)$
- $j=2$ : $4>2$ :
  $(1,4,2,3,5)\xrightarrow{(2\ 3)}(1,2,4,3,5)$
- $j=3$ : $4>3$ :
  $(1,2,4,3,5)\xrightarrow{(3\ 4)}(1,2,3,4,5)$

Les passes suivantes ne changent plus rien.

### 2) Pourquoi tri bulle termine et trie toujours

**Raisonnement a avoir**

1. **Terminaison** : les deux boucles ont des bornes finies ($i=1$ a $n-1$, et $j=1$ a $n-i$).
2. **Invariant** : a la fin de la passe $i$, le plus grand element de la zone non triee est en position $n-i+1$.
3. **Progression** : la partie triee a droite gagne une case a chaque passe.
4. **Conclusion** : apres $n-1$ passes, tout est trie en ordre croissant.

### 3) En deduire que toute permutation est produit de transpositions

Ici, je te donne le raisonnement "type examen" pas a pas.

#### Etape A - Traduire ce que fait le tri

On prend une permutation initiale $\pi$ (vue comme une suite des images $\pi(1),\dots,\pi(n)$).
Le tri bulle fait des echanges adjacents $\tau_1,\tau_2,\dots,\tau_m$ (dans l'ordre chronologique).

Comme le tri finit sur la suite triee $(1,2,\dots,n)$, cela veut dire qu'on a obtenu l'identite :

$$
\pi\,\tau_1\tau_2\cdots\tau_m=\mathrm{Id}.
$$

Pourquoi cette ecriture ?
Parce qu'un echange de positions agit sur les indices (donc compose a droite de la permutation ecrite en ligne).

#### Etape B - Isoler $\pi$

On multiplie a droite par l'inverse de $\tau_1\cdots\tau_m$ :

$$
\pi=(\tau_1\tau_2\cdots\tau_m)^{-1}.
$$

Puis on utilise deux faits :

- inverse d'un produit :
  $(ab\cdots z)^{-1}=z^{-1}\cdots b^{-1}a^{-1}$
- une transposition est involutive :
  $\tau_i^{-1}=\tau_i$

Donc

$$
\pi=\tau_m\cdots\tau_2\tau_1.
$$

On a donc ecrit $\pi$ comme produit de transpositions.

#### Etape C - Application a la permutation demandee

La permutation de l'enonce est

$$
\beta=\begin{pmatrix}
1&2&3&4&5\\
4&5&1&2&3
\end{pmatrix},
$$

et la suite associee est $(4,5,1,2,3)$.

Le tri bulle a effectue (ordre chronologique) :

$$
\tau_1=(2\ 3),\ \tau_2=(3\ 4),\ \tau_3=(4\ 5),\ \tau_4=(1\ 2),\ \tau_5=(2\ 3),\ \tau_6=(3\ 4).
$$

Donc

$$
\beta=\tau_6\tau_5\tau_4\tau_3\tau_2\tau_1
=(3\ 4)(2\ 3)(1\ 2)(4\ 5)(3\ 4)(2\ 3).
$$

**Point de vigilance**

Ne pas ecrire les facteurs dans le meme ordre que la chronologie sans inverser :
avec notre convention droite-gauche, l'expression finale est bien la chronologie lue a l'envers.

### 4) Quel est le sous-groupe engendre par $(j\ j+1)$ ?

**Raisonnement a avoir**

- Le tri bulle montre deja qu'avec les transpositions adjacentes on peut trier n'importe quel arrangement.
- Donc, en remontant le tri, on peut construire n'importe quelle permutation.

Conclusion :

$$
\langle (1\ 2),(2\ 3),\dots,(n-1\ n)\rangle=S_n.
$$

### 5) Comprendre le tri selection

**Raisonnement a avoir**

A l'etape $i$, on regarde la partie non triee (de 1 a $n-i+1$),
on y cherche le maximum, puis on l'echange avec la derniere case de cette zone.

Donc a chaque etape, un element est "place definitivement" a droite.

### 6) Montrer que tri selection termine et trie

**Raisonnement a avoir**

1. **Terminaison** : les boucles sont finies.
2. **Invariant** : apres l'etape $i$, les $i$ dernieres positions contiennent les $i$ plus grands elements, bien ranges.
3. **Conclusion** : apres $n-1$ etapes, tout est trie.

### 7) Decomposer la meme permutation avec tri selection

On part de

$$
(4,5,1,2,3).
$$

Etape 1 : max de la zone (positions 1..5) = 5 en position 2, on l'envoie en position 5 :

$$
(4,5,1,2,3)\xrightarrow{(2\ 5)}(4,3,1,2,5).
$$

Etape 2 : max de la zone (1..4) = 4 en position 1, on l'envoie en position 4 :

$$
(4,3,1,2,5)\xrightarrow{(1\ 4)}(2,3,1,4,5).
$$

Etape 3 : max de la zone (1..3) = 3 en position 2, on l'envoie en position 3 :

$$
(2,3,1,4,5)\xrightarrow{(2\ 3)}(2,1,3,4,5).
$$

Etape 4 : max de la zone (1..2) = 2 en position 1, on l'envoie en position 2 :

$$
(2,1,3,4,5)\xrightarrow{(1\ 2)}(1,2,3,4,5).
$$

Chronologie des echanges :

$$
(2\ 5),\ (1\ 4),\ (2\ 3),\ (1\ 2).
$$

Donc, avec la meme logique qu'en 3),

$$
\beta=(1\ 2)(2\ 3)(1\ 4)(2\ 5).
$$

### 8) Pourquoi la decomposition en transpositions n'est pas unique

**Raisonnement a avoir**

Tu as obtenu deux ecritures de la meme permutation $\beta$ :

$$
\beta=(3\ 4)(2\ 3)(1\ 2)(4\ 5)(3\ 4)(2\ 3)
$$

et

$$
\beta=(1\ 2)(2\ 3)(1\ 4)(2\ 5).
$$

Les deux produits sont differents (pas meme longueur, pas memes facteurs), mais donnent la meme permutation.

Conclusion : la decomposition d'une permutation en produit de transpositions n'est pas unique.

