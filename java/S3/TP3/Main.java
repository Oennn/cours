public class Main {
    public static void main(String[] args) {

        ListeChainee<Integer> liste = new ListeChainee<>();

        // Ajout d'éléments
        liste.ajouterEnTete(3);
        liste.ajouterEnTete(2);
        liste.ajouterEnQueue(1);

        // Affichage de la liste
        System.out.print(liste+"\n");

        System.out.print( "\n is here : "+ liste.isHere(2)+" "+liste.ref(20)+"\n");





        ListeDoublementChainee<Integer> liste2 = new ListeDoublementChainee<>();
        liste2.ajouterEnQueue(3);
        liste2.ajouterEnQueue(2);
        liste2.ajouterEnQueue(1);
        liste2.ajouterEnQueue(1);
        liste2.ajouterEnQueue(1);
        System.out.print(liste2);
        System.out.print("\n"+liste2.isHere(1)+" "+liste2.ref(2)+"\n");
        System.out.print(liste2.retirer(2)+"\n");
        System.out.print(liste2);
        for (Integer s : liste) { // for-each utilise ton iterator
            System.out.println(s);
        }

         ListeChainee<String> liste3 = new ListeChainee<>();
        liste3.ajouterEnTete("A");
        liste3.ajouterEnTete("B");
        liste3.ajouterEnQueue("C");

        System.out.println("Affichage classique :");
        System.out.println(liste3);

        System.out.println("Affichage avec iterator :");
        for (String s : liste3) { // for-each utilise ton iterator
            System.out.println(s);
        }
    }

    /* 
    ListeChainee<T>
    Le <T> indique que la classe est générique.    
    ListeChainee<Integer> l1 = new ListeChainee<>();
    ListeChainee<String> l2 = new ListeChainee<>();
    ListeChainee<Double> l3 = new ListeChainee<>();
    Donc :

    T sera remplacé par Integer, String, etc.

    on évite d’écrire une liste différente pour chaque type
           */
    
}

