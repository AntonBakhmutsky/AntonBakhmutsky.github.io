const myself = {
  name: 'Max',
  friends: [
    {
      name: 'Manuel',
      friends: [
        {name: 'Hari'},
        {name: 'Chris'},
      ]
    },
    {
      name: 'Julia',
      friends: [
        {name: 'Harold'}
      ]
    }
  ]
}

function getFriendNames(person) {
  const collectedNames = [];

  if (!person.friends) {
    return;
  }

  for (const friend in person.friends) {
    collectedNames.push(friend.name);
    collectedNames.push(...getFriendNames(friend));
  }

  return collectedNames;
}

console.log(getFriendNames(myself));
