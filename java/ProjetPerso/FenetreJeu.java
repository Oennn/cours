import javax.swing.*;   // Composants Swing (JFrame, JButton, JTextArea, JScrollPane, etc.)
import java.awt.*;      // Layouts (BorderLayout)

/**
 * Fenêtre principale du jeu de combat
 */
public class FenetreJeu extends JFrame {

    // Zone de texte pour afficher les messages du combat
    private JTextArea zoneTexte;

    // Bouton permettant de lancer le tour suivant
    private JButton boutonTour;

    // Objet qui contient toute la logique du combat
    private Combat combat;

    /**
     * Constructeur de la fenêtre
     */
    public FenetreJeu() {

        // Création des personnages du jeu
        Hero hero = new Hero(ClasseHero.GUERRIER);
        Ennemies ennemi = new Ennemies(ClasseEnnemie.ZOMBIE);

        // Initialisation du combat entre le héros et l'ennemi
        combat = new Combat(hero, ennemi);

        // Paramètres de la fenêtre
        setTitle("Jeu de Combat");               // Titre de la fenêtre
        setSize(500, 400);                       // Taille de la fenêtre
        setDefaultCloseOperation(DISPOSE_ON_CLOSE); // Ferme le programme à la fermeture
        setLayout(new BorderLayout());            // Organisation de la fenêtre
        setLocationRelativeTo(null);

        // Création de la zone de texte pour afficher le déroulement du combat
        zoneTexte = new JTextArea();
        zoneTexte.setEditable(false);             // Empêche l'utilisateur de modifier le texte
        add(new JScrollPane(zoneTexte), BorderLayout.CENTER);
        // JScrollPane permet le défilement quand le texte dépasse la taille

        // Création du bouton "Tour suivant"
        boutonTour = new JButton("Tour suivant");
        add(boutonTour, BorderLayout.SOUTH);      // Placé en bas de la fenêtre

        // Action déclenchée lorsque l'utilisateur clique sur le bouton
        boutonTour.addActionListener(e -> {

            // Lance un tour de combat et affiche le résultat
            zoneTexte.append(combat.tourDeCombat() + "\n\n");

            // Si le combat est terminé
            if (combat.estTermine()) {
                boutonTour.setEnabled(false);     // Désactive le bouton
                zoneTexte.append("⚔️ Combat terminé !");
            }
        });
    }

    /**
     * Point d'entrée du programme
     */
    public static void main(String[] args) {

        // Lance l'interface graphique sur le thread Swing (EDT = thread graphique)
        SwingUtilities.invokeLater(() -> {
            new FenetreJeu().setVisible(true);     // Affiche la fenêtre
        });
    }
}
