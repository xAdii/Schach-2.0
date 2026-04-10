<h1>Schach Anleitung</h1>
<?php include './modules/navigation.php'; ?>
<section>
    <h2>Grundregeln</h2>
    <ul>
        <li>Schach wird auf einem 8x8-Brett mit 16 Figuren pro Spieler gespielt.</li>
        <li>Ziel ist es, den gegnerischen König schachmatt zu setzen.</li>
        <li>Jede Figur hat eigene Zugregeln (Bauer, Turm, Springer, Läufer, Dame, König).</li>
        <li>Weiß beginnt das Spiel.</li>
    </ul>
</section>
<section>
    <h2>Die Figuren</h2>
    <ul>
        <li><strong>Bauer:</strong> Zieht ein Feld vorwärts, schlägt diagonal.</li>
        <li><strong>Turm:</strong> Zieht beliebig viele Felder waagerecht oder senkrecht.</li>
        <li><strong>Springer:</strong> Zieht in L-Form (zwei Felder in eine Richtung, dann eins im rechten Winkel).</li>
        <li><strong>Läufer:</strong> Zieht beliebig viele Felder diagonal.</li>
        <li><strong>Dame:</strong> Zieht beliebig viele Felder in alle Richtungen.</li>
        <li><strong>König:</strong> Zieht ein Feld in jede Richtung.</li>
        <li><strong>Verwirrter Bauer:</strong> Zieht ein Feld nach links oder rechts, wenn das Feld frei ist. Er schlägt gegnerische Figuren diagonal ein Feld in jede Richtung.</li>
        <li><strong>Gazelle:</strong> Springt auf Felder, die zwei Reihen oder Spalten entfernt liegen und höchstens ein Feld seitlich versetzt sind. Sie kann dabei über andere Figuren springen.</li>
        <li><strong>Pony:</strong> Springt genau zwei Felder waagerecht oder senkrecht und kann über andere Figuren springen.</li>
        <li><strong>Prinzessin:</strong> Zieht bis zu zwei Felder in jede Richtung, also gerade oder diagonal. Andere Figuren blockieren ihren Weg.</li>
        <li><strong>Thomas:</strong> Zieht ein Feld geradeaus, wenn das Feld frei ist. Er schlägt gegnerische Figuren genau zwei Felder geradeaus.</li>
    </ul>
</section>
<section>
    <h2>Punktesystem und Figurenkauf</h2>
    <ul>
        <li>Jeder Spieler startet vor dem Spiel mit 5 Punkten.</li>
        <li>Pro Spiel dürfen maximal 3 Figuren gekauft werden.</li>
        <li>Am Anfang darf nur 1 gekaufte Figur auf einmal gesetzt werden.</li>
        <li>Gekaufte Figuren werden am Anfang in der 3. Reihe gesetzt. Danach dürfen sie nur noch auf festgelegten Plätzen eingesetzt werden.</li>
        <li>Wenn ein Bauer verwandelt wird, zählt danach der Punktewert der neuen Figur.</li>
    </ul>
    <div class="rules-table-wrapper">
        <table class="rules-table">
            <thead>
                <tr>
                    <th>Figur</th>
                    <th>Kosten</th>
                    <th>Punkte bei Tod</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bauer</td>
                    <td>-</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Springer</td>
                    <td>-</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>Läufer</td>
                    <td>-</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>Turm</td>
                    <td>-</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Dame</td>
                    <td>-</td>
                    <td>9</td>
                </tr>
                <tr>
                    <td>König</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Gazelle</td>
                    <td>8</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>Prinzessin</td>
                    <td>15</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>Pony</td>
                    <td>3</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>Verwirrter Bauer</td>
                    <td>2</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Prinz Thomas</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<section>
    <h2>Shop und Items</h2>
    <ul>
        <li>Der Shop erscheint zufällig und bietet 4 Items an.</li>
        <li>Beim Kaufen im Shop pausiert das Spiel. Das Kaufen im Shop verbraucht keinen normalen Zug.</li>
        <li>Man kann den Shop des Gegners zwei Runden vorher sehen, bevor der Gegner ihn selbst sieht.</li>
        <li>Ein Spieler kann maximal 3 Items gleichzeitig haben. Dazu zählen Power-Ups und andere Items.</li>
        <li>Der Shop wählt Items aus verschiedenen Seltenheitsstufen aus: Gewöhnlich, Selten und Legendär.</li>
    </ul>
    <div class="rules-table-wrapper">
        <table class="rules-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Kosten</th>
                    <th>Seltenheit</th>
                    <th>Rate</th>
                    <th>Dauer</th>
                    <th>Effekt</th>
                    <th>Verbrauch</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Königsleben</td>
                    <td>20?</td>
                    <td>Legendär</td>
                    <td>10%</td>
                    <td>-</td>
                    <td>Der König hat ein zusätzliches Leben. Beim Tod kehrt er auf seine Startposition zurück. Ist die Startposition besetzt, ist es Schachmatt.</td>
                    <td>Muss im Inventar liegen und wird verbraucht, wenn der König schachmatt wäre.</td>
                </tr>
                <tr>
                    <td>Tarnumhang</td>
                    <td>10?</td>
                    <td>Selten</td>
                    <td>20%</td>
                    <td>2 Runden</td>
                    <td>Macht die ausgewählte Figur für einen eigenen und einen gegnerischen Zug unsichtbar.</td>
                    <td>Wird einer Figur gegeben und verschwindet nach Gebrauch.</td>
                </tr>
                <tr>
                    <td>Weitsprung</td>
                    <td>4?</td>
                    <td>Gewöhnlich</td>
                    <td>60%</td>
                    <td>Einmalig</td>
                    <td>Gibt Springer, Thomas, Bauer oder Pony eine größere Zugauswahl mit einem großen L aus 3 Schritten vorwärts. Der Zug ist nicht erlaubt, wenn der eigene König dadurch in Gefahr wäre.</td>
                    <td>Wird einer Figur gegeben und verschwindet nach einem Zug.</td>
                </tr>
                <tr>
                    <td>Bestechung</td>
                    <td>3?</td>
                    <td>Gewöhnlich</td>
                    <td>60%</td>
                    <td>Einmalig</td>
                    <td>Ein gegnerischer Bauer läuft auf die eigene Seite über. Bauern können sich am Ende des Spielfeldes dadurch nicht verwandeln.</td>
                    <td>Wird auf einen gegnerischen Bauern angewendet. Danach ist der eigene Zug vorbei.</td>
                </tr>
                <tr>
                    <td>Medusa-Fluch</td>
                    <td>7?</td>
                    <td>Gewöhnlich</td>
                    <td>35%</td>
                    <td>1 Runde</td>
                    <td>Die geschützte Figur kann nicht kaputt gemacht werden. Sie darf in dieser Runde nicht bewegt werden, aber eine andere Figur darf noch ziehen. Nicht auf den König anwendbar.</td>
                    <td>Wird einer Figur gegeben und verschwindet nach Benutzung.</td>
                </tr>
                <tr>
                    <td>Double Dash</td>
                    <td>12?</td>
                    <td>Legendär</td>
                    <td>20%</td>
                    <td>Einmalig</td>
                    <td>Eine Figur darf doppelt ziehen. Aktivierbar, wenn mindestens 10 Figurenpunkte Unterschied bestehen.</td>
                    <td>Wird einer Figur gegeben und verschwindet nach Benutzung.</td>
                </tr>
                <tr>
                    <td>Hammer</td>
                    <td>6?</td>
                    <td>Selten</td>
                    <td>50%</td>
                    <td>Einmalig</td>
                    <td>Kann alle Hindernisse zerstören.</td>
                    <td>Verschwindet nach dem Auswählen des zu zerstörenden Hindernisses.</td>
                </tr>
                <tr>
                    <td>Detektor</td>
                    <td>7?</td>
                    <td>Selten</td>
                    <td>30%</td>
                    <td>Einmalig</td>
                    <td>Deckt Fallen, unsichtbare Items wie Truhen und unsichtbare Figuren in einem Suchbereich auf.</td>
                    <td>Der Spieler wählt einen Bereich zum Untersuchen aus. Danach darf er noch eine Figur ziehen.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<section>
    <h2>Hindernisse und Fallen</h2>
    <p>Manche Hindernisse spawnen am Anfang des Spiels zufällig auf dem Brett.</p>
    <p>Alle Hindernisse können mit dem Hammer zerstört werden.</p>
    <div class="rules-table-wrapper">
        <table class="rules-table">
            <thead>
                <tr>
                    <th>Hindernis</th>
                    <th>Seltenheit</th>
                    <th>Kosten</th>
                    <th>Zerstörbar?</th>
                    <th>Zusatzeffekt</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Stein</td>
                    <td>Gewöhnlich</td>
                    <td>5?</td>
                    <td>Nur mit Hammer</td>
                    <td>Blockiert ein Feld. Maximal 3 Steine gleichzeitig.</td>
                </tr>
                <tr>
                    <td>Rampe</td>
                    <td>Selten</td>
                    <td>7?</td>
                    <td>Nur mit Hammer</td>
                    <td>Nur aus einer Richtung begehbar. Maximal 2 Rampen gleichzeitig.</td>
                </tr>
                <tr>
                    <td>Skelett</td>
                    <td>Gewöhnlich</td>
                    <td>4?</td>
                    <td>Ja, 1 Zug</td>
                    <td>Funktioniert wie ein Stein, kann aber von Figuren geschlagen werden. Skelette spawnen neben geschlagenen Figuren.</td>
                </tr>
                <tr>
                    <td>Bananenschale</td>
                    <td>Selten</td>
                    <td>3</td>
                    <td>Ja, 1 Zug</td>
                    <td>Kann hinter gezogenen Figuren spawnen, im Shop gekauft werden oder zufällig erscheinen. Tritt eine Figur darauf, wird sie auf ein zufälliges freies Nachbarfeld verschoben.</td>
                </tr>
                <tr>
                    <td>Trittfalle</td>
                    <td>Selten</td>
                    <td>9?</td>
                    <td>Ja, 1 Zug</td>
                    <td>Ein Spieler kann maximal gleichzeitig nur eine Falle auf dem Spielfeld haben. Eine Figur kann den Rest des Zuges nicht weiterlaufen, wenn sie auf die Falle geht.</td>
                </tr>
                <tr>
                    <td>Degradierung</td>
                    <td>Legendär</td>
                    <td>13</td>
                    <td>Ja, 1 Zug</td>
                    <td>Degradiert den Figurenwert: Dame oder Prinzessin werden zu Turm, Läufer oder Springer. Turm, Läufer oder Springer werden zu einem Bauern.</td>
                </tr>
                <tr>
                    <td>Truhe</td>
                    <td>-</td>
                    <td>-</td>
                    <td>Ja, 1 Zug</td>
                    <td>Kann in den ersten 15 Zügen in den Reihen 3 bis 6 spawnen, danach überall. Sie wird über 3 Züge langsam ausgegraben, damit beide Spieler sie erreichen können.</td>
                </tr>
                <tr>
                    <td>Teleporter</td>
                    <td>Selten</td>
                    <td>7</td>
                    <td>Nur mit Hammer</td>
                    <td>Nur 1 Teleporter pro Spiel. Das Ziel liegt in der Mitte des Bretts. Der Teleporter darf nicht auf Figuren landen und nicht ins Schach führen.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<section>
    <h2>Besondere Regeln</h2>
    <ul>
        <li><strong>Rochade:</strong> Ein spezieller Zug mit König und Turm.</li>
        <li><strong>En passant:</strong> Ein spezieller Schlagzug des Bauern.</li>
        <li><strong>Bauernumwandlung:</strong> Ein Bauer, der die gegnerische Grundreihe erreicht, wird zur Dame (oder einer anderen Figur).</li>
    </ul>
</section>
<section>
    <h2>Spielende</h2>
    <ul>
        <li>Schachmatt: Der König ist bedroht und kann nicht entkommen.</li>
        <li>Patt: Der Spieler ist am Zug, kann aber keinen legalen Zug machen und der König steht nicht im Schach.</li>
        <li>Remis: Unentschieden durch verschiedene Regeln (z.B. dreifache Stellungswiederholung, 50-Züge-Regel).</li>
    </ul>
</section>
