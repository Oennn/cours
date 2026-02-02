public class Combat {
    private Hero hero;
    private Ennemies ennemi;

    public Combat(Hero hero, Ennemies ennemi) {
        this.hero = hero;
        this.ennemi = ennemi;
    }

    public String tourDeCombat() {
        if (!hero.estVivant() || !ennemi.estVivant()) {
            return "Le combat est terminé.";
        }
        // Création d'un StringBuilder pour construire le texte du tour de combat
        // StringBuilder est utilisé car il est plus efficace que les concaténations de String
        // quand on ajoute plusieurs morceaux de texte successivement.
        StringBuilder log = new StringBuilder();

        int attaqueH = attaqueAlea(hero.getAttaque());

        // Ajoute au log le message de l'attaque du héros
        // append() permet d'ajouter du texte à la suite sans créer de nouveaux objets String
        log.append(hero.getNom())          // Nom du héros
            .append(" attaque ")            // Texte fixe
            .append(ennemi.getNom())        // Nom de l'ennemi
            .append(" pour ")               // Texte fixe
            .append(attaqueH)               // Dégâts infligés
            .append(" dégâts.\n");          // Fin de ligne

        ennemi.subirDegats(attaqueH);


        // Si l'ennemi est vaincu, on ajoute le message de fin au log
        // puis on retourne directement le texte construit
        if (!ennemi.estVivant()) {
            log.append(ennemi.getNom()).append(" est vaincu !");
            return log.toString();          // Conversion du StringBuilder en String
        }

        int attaqueE = attaqueAlea(ennemi.getAttaque());
        log.append(ennemi.getNom())
           .append(" attaque ")
           .append(hero.getNom())
           .append(" pour ")
           .append(attaqueE)
           .append(" dégâts.\n");

        hero.subirDegats(attaqueE);
        // Si le héros est vaincu, on ajoute le message correspondant au log
        if (!hero.estVivant()) {
            log.append(hero.getNom()).append(" est vaincu !");
        }

        // Retourne l'ensemble du texte du tour de combat
        // toString() transforme le StringBuilder en String exploitable par l'interface graphique
        return log.toString();
    }




    public boolean estTermine() {
        return !hero.estVivant() || !ennemi.estVivant();
    }

    private int attaqueAlea(int attaque) {
        int min = (int)(attaque * 0.8);
        int max = (int)(attaque * 1.2);
        return min + (int)(Math.random() * (max - min + 1));
    }
}
