import random

def generate_minesweeper_grid(width, height, num_bombs):
    # Initialize the grid with zeros
    grid = [['0️⃣' for _ in range(width)] for _ in range(height)]
    
    # Place the bombs
    bombs_placed = 0
    while bombs_placed < num_bombs:
        x = random.randint(0, width - 1)
        y = random.randint(0, height - 1)
        if grid[y][x] != '💥':
            grid[y][x] = '💥'
            bombs_placed += 1
            
            # Update adjacent cells
            for dy in [-1, 0, 1]:
                for dx in [-1, 0, 1]:
                    if dx == 0 and dy == 0:
                        continue
                    ny, nx = y + dy, x + dx
                    if 0 <= ny < height and 0 <= nx < width and grid[ny][nx] != '💥':
                        grid[ny][nx] = str(int(grid[ny][nx].replace('️⃣', '')) + 1) + '️⃣'
    
    # Convert grid to the requested text format
    grid_text = []
    for row in grid:
        grid_text.append('||' + '||'.join(row) + '||')

    return '\n'.join(grid_text)

def main():
    height = width = int(input("Enter the width and height of the grid: "))
    num_bombs = int(input("Enter the number of bombs: "))

    # Ensure number of bombs is valid
    if num_bombs > width * height:
        print("Number of bombs exceeds the number of cells. Adjusting to maximum possible.")
        num_bombs = width * height

    # Generate and print the grid
    grid_text = generate_minesweeper_grid(width, height, num_bombs)
    print("\nGenerated Minesweeper Grid:\n")
    print(grid_text)

if __name__ == "__main__":
    main()
