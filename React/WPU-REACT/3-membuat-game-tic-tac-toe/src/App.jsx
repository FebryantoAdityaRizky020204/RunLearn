/* eslint-disable react/prop-types */
import { useState } from "react"


function Square({value, onSquareClick}) {
  return <button className="square" onClick={onSquareClick}>{value}</button>
}

function Board({nowIsX, squares, onPlay}) {
  const winner = calculateWinner(squares);
  let status;
  if (winner) { status = 'Winner: ' + winner }
  else { status = 'Now Run: ' + (nowIsX ? 'X' : 'O') };
  

  function onSquareClick(i) {
    if (squares[i] !== null || calculateWinner(squares)) return;
    
    const nowSquares = squares.slice();
    nowSquares[i] = nowIsX ? 'X' : 'O';
    onPlay(nowSquares);
  }

  return (
    <>
      <div className="status">{status}</div>
      <div className="papan">
        <Square value={squares[0]} onSquareClick={() => onSquareClick(0)}/>
        <Square value={squares[1]} onSquareClick={() => onSquareClick(1)} />
        <Square value={squares[2]} onSquareClick={() => onSquareClick(2)} />
        <Square value={squares[3]} onSquareClick={() => onSquareClick(3)} />
        <Square value={squares[4]} onSquareClick={() => onSquareClick(4)} />
        <Square value={squares[5]} onSquareClick={() => onSquareClick(5)} />
        <Square value={squares[6]} onSquareClick={() => onSquareClick(6)} />
        <Square value={squares[7]} onSquareClick={() => onSquareClick(7)} />
        <Square value={squares[8]} onSquareClick={() => onSquareClick(8)} />
      </div>
    </>
  )
}

export default function App() {
  const [nowIsX, setNowIsX] = useState(true);
  // const nowIsX = step % 2 === 0, cara lain yg lebih sederhana untuk mengetahui siapa yang bermain
  let [history, setHistory] = useState([Array(9).fill(null)]);
  const [currentMove, setCurrentMove] = useState(0);
  const currentSquares = history[currentMove];

  function handlePlay(nowSquares) { 
    const newHistory = [...history.slice(0, currentMove+1), nowSquares];
    setHistory(newHistory);
    setCurrentMove(newHistory.length-1);
    setNowIsX(!nowIsX);
  }

  function jumpTo(step) {
    setCurrentMove(step);
    setNowIsX(step % 2 === 0);
    setHistory(history.slice(0, step + 1));
  }

  const moves = history.map((squares, move) => {
    let text = (move > 0) ? 'Go to move #' + move : 'Go to game start';

    return (
      <li key={move}>
        <button onClick={() => jumpTo(move)}>{text}</button>
      </li>
    );
  });

  return (
    <div className="game">
      <div className="game-board">
        <Board nowIsX={nowIsX} squares={currentSquares} onPlay={handlePlay} />
      </div>
      <div className="game-info">
        <ol>
          {moves}
        </ol>
      </div>
    </div>
  )
}

function calculateWinner(squares) {
  const lines = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];
  for (let i = 0; i < lines.length; i++) {
    const [a, b, c] = lines[i];
    if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
      return squares[a];
    }
  }
  return null;
}

