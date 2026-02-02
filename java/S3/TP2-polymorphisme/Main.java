public class Main {
    public static void main(String[] args) {

        Maison maison1 = new Maison("Maison 1", "Paris", 80, 4, false);
        Maison maison2 = new Maison("Maison 2", "Lyon", 120, 5, true);
        Usine usine = new Usine("Usine Centrale", "Lille", 3000, "Renault");


        Batiment[] batiments = {maison1, maison2, usine};


        Mairie mairie = new Mairie("Ma Commune", "Maire X", 15000, batiments);


        double impotsTotal = mairie.getImpotsTotal();
        System.out.println("Impôts totaux perçus : " + impotsTotal);


        String batimentMax = mairie.getImpotsMax();
        System.out.println("Bâtiment payant le plus d'impôts : " + batimentMax);

    }
}
