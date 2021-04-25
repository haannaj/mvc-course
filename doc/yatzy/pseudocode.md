FOR dice in game
   roll dice
ENDFOR

IF dice selected to save THEN
    disable dice
ENDIF

IF number of throws > three times THEN
    sum up value and reset dices
ELSE
    throw dices
ENDIF

IF all 'dice-position' filled THEN
    sum up all value, distribute bonuses
ELSE
    keep playing
ENDIF
