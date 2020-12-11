// DECLARATION

const	calcul = (a, b) => {
	return (new Promise((resolve, reject) => {
		const	result = a * b;
	
		if (result < 100) {
			resolve(result);
		}
		else {
			reject('result is too big');
		}
	}));
};

// UTILISATION

// calcul(10, 1).then((result) => {
// 	console.log('Resolve : ' + result);
// }).catch((error) => {
// 	console.log('Reject : ' + error);
// });


function		getProbOfWin() {
	console.log('=> calc...');

	return ('100%');
}

function		singleton(ft) {
	let	lastResult;
	let	count = -1;

	return (() => {
		++count;
		if (count > 4) {
			lastResult = undefined;
			count = 0;
		}
		return (lastResult ? lastResult : (lastResult = ft()));
	});
}

let			memoized = singleton(getProbOfWin);

function	showProbOfWin() {
	console.log('probOfWin: ' + memoized());
}

// showProbOfWin();
// showProbOfWin();
// showProbOfWin();
// showProbOfWin();
// showProbOfWin();
// showProbOfWin();

(async () => {
	let	funcTest = (ms) => {
		return (new Promise((resolve, reject) => {
			let	isTrue = true;

			setTimeout(() => { // permet de mettre un delay avant l'envois de la réponse
				if (isTrue)
					resolve('test');
				else
					reject('error');
			}, ms);
		}));
	};

	console.log('before');
	let	str = await funcTest(1000);
	console.log('after');
	return (str);
})()
.then((str) => {
	console.log(str);
})
.catch((error) => {
	console.log(error);
});

