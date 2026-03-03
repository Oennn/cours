package Controller;
import Model.Feu;
import View.VueFeu;

import javax.swing.*;
import java.awt.*;

public class FeuGUI extends JFrame {
    private Feu modele;

    public FeuGUI() { this(new Feu()); }

    public FeuGUI(Feu f) {
        this.modele = f;
        setTitle("Feu Tricolore");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLayout(new BorderLayout());

        // Ajout de la Vue au centre
        VueFeu vue = new VueFeu(modele);
        add(vue, BorderLayout.CENTER);

        // Ajout du Contrôleur (Bouton) au sud
        JButton btnSuivant = new JButton("Next");
        btnSuivant.addActionListener(e -> modele.suivant());
        add(btnSuivant, BorderLayout.SOUTH);

        pack();
        setVisible(true);
    }

    public static void main(String[] args) {
        Feu f = new Feu();
        new FeuGUI(f);

    }
}