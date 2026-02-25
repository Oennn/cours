import javax.swing.*;
import java.awt.*;

public class ConvertisseurPanel extends JPanel {

    private JTextField champDevise1;
    private JTextField champDevise2;

    public ConvertisseurPanel() {

        // Choix du layout
        setLayout(new GridLayout(3, 1, 5, 5));

        // Création des composants
        champDevise1 = new JTextField();
        champDevise2 = new JTextField();

        JPanel panelBoutons = new JPanel();
        panelBoutons.setLayout(new GridLayout(1, 3, 5, 5));

        panelBoutons.add(new JButton("Bouton 1"));
        panelBoutons.add(new JButton("Bouton 2"));
        panelBoutons.add(new JButton("Bouton 3"));

        // Assemblage

        add(champDevise1);
        add(champDevise2);
        add(panelBoutons);

    }
}