<?php
abstract class AbstractSubject {
  abstract function attach(AbstractObserver $observer_in);
  abstract function detach(AbstractObserver $observer_in);
  
  abstract function notify();
}
abstract class AbstractObserver {
  abstract function update(AbstractSubject $subject);

}
class PatternObserver extends AbstractObserver {
  public function __construct() {

  }

  public function update(Abstractsubject $subject) {
    echo BR.BR;
    echo '*IN PATTERN OBSERVER - NEW PATTERN GOSSIP ALERT*'.BR;
    echo ' new favorite patterns: '.$subject->getFavorites().BR;
    echo '*IN PATTERN OBSERVER - PATTERN GOSSIP ALERT OVER*'.BR;
  }
}
class PatternSubject extends AbstractSubject {
  private $favoritePatterns = NULL;

  private $observers = array();

  function __construct() {

  }

  function attach(AbstractObserver $observer_in) {
    $this->observers[] = $observer_in;
  }

  function detach(AbstractObserver $observer_in) {
    foreach($this->observers as $okey => $oval) {
      if ($oval == $observer_in) {
        unset($this->observers[$okey]);
      }
    }
  }
  
  function notify() {
    foreach($this->observers as $obs) {
      $obs->update($this);
    }
  }

  function updateFavorites($newFavorites) {
    $this->favorites = $newFavorites;
    $this->notify();
  }

  function getFavorites() {
    return $this->favorites;
  }

}

define ('BR', '<'.'BR'.'>');

echo 'Test Observer Pattern'.BR;
echo BR;

$patternGossiper = new PatternSubject();
$patternGossipFan = new PatternObserver();
$patternGossiper->attach($patternGossipFan);

$patternGossiper->updateFavorites(
  'abstract factory, decorator, visitor');

$patternGossiper->updateFavorites(
  'abstract factory, observer, decorator');
$patternGossiper->detach($patternGossipFan);

$patternGossiper->updateFavorites(
  'abstract factory, observer, paisley');

echo BR.BR;
echo 'END TESTING';

?>
