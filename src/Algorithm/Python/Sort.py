def find(arr):
    smallest = arr[0]
    smallest_index = 0
    for i in range(1, len(arr)):
        if arr[i] < smallest:
            smallest_index = i
            smallest = arr[i]
    return smallest_index


def selection(arr):
    new = []
    for i in range(len(arr)):
        smallest = find(arr)
        new.append(arr.pop(smallest))
    return new


print(selection([4, 5, 2, 4, 53, 4]))
