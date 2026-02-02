public enum ClasseHero {
    
    GUERRIER(120, 20),
    MAGE(80, 30),
    ARCHER(100, 25);

    //pour pas changer les stats
    private final int pvBase;
    private final int attaqueBase;

    //constructeur d un enum est tjr private
    ClasseHero(int pvBase, int attaqueBase) {
        this.pvBase = pvBase;
        this.attaqueBase = attaqueBase;
    }

    public int getPvBase() {
        return pvBase;
    }

    public int getAttaqueBase() {
        return attaqueBase;
    }

}
